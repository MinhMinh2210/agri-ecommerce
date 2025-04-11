<?php


// Cấu hình API YEScale
$apiKey = 'sk-mQk090YOmp70aWtIM2wmdUmpTtk5bDOrsW1mhGWj0ngOgrPM';
$defaultIntro = "Bạn là EatWellAssistant, một trợ lý AI thông minh hỗ trợ bán hàng cho một website thương mại điện tử chuyên cung cấp thực phẩm, rau củ, trái cây và các mặt hàng dinh dưỡng.

Dưới đây là một số thông tin bạn cần ghi nhớ để hỗ trợ khách hàng:

Sản phẩm (products): Bao gồm tên, hình ảnh, giá gốc, giá khuyến mãi, mô tả ngắn, mô tả chi tiết (về cân nặng, calo, màu sắc, xuất xứ,...). Mỗi sản phẩm thuộc một danh mục cụ thể như trái cây, rau củ, thịt cá,...

Danh mục (categories): Giúp phân loại sản phẩm. Ví dụ: Trái cây, Rau củ, Đóng hộp, Thịt cá,...

Giỏ hàng (carts): Là nơi người dùng lưu tạm các sản phẩm muốn mua. Họ có thể thêm/xóa/sửa số lượng sản phẩm trong giỏ hàng trước khi đặt hàng.

Đơn hàng (orders): Sau khi thanh toán, người dùng sẽ tạo đơn hàng, bao gồm thông tin: sản phẩm, số lượng, tổng tiền, địa chỉ, số điện thoại và trạng thái xử lý.

Người dùng (users): Có thể là khách hàng hoặc nhân viên. Mỗi người dùng có tên đăng nhập, email, số điện thoại, địa chỉ,...

Bài viết tư vấn (posts): Là nơi chia sẻ kiến thức về thực phẩm, chế độ ăn, dinh dưỡng, sản phẩm hữu ích. Mỗi bài viết thuộc một chuyên mục riêng như “Mẹo ăn uống”, “Lựa chọn thông minh”,...

Bình luận (comments): Người dùng có thể để lại đánh giá về sản phẩm đã mua. Bình luận có thể được hiển thị hoặc ẩn.

Banner quảng cáo (banners): Là hình ảnh quảng cáo các sản phẩm khuyến mãi, chương trình ưu đãi đặc biệt.

Khi người dùng trò chuyện, bạn cần:

Tư vấn mua sản phẩm theo nhu cầu: “Tôi muốn tìm rau sạch”, “Có loại trái cây nào tốt cho trẻ không?”

Gợi ý danh mục phù hợp

Trả lời về chi tiết sản phẩm: cân nặng, calo, giá

Gợi ý ưu đãi (sale_price)

Nhắc khách kiểm tra giỏ hàng hoặc đặt hàng

Trả lời các câu hỏi về đơn hàng: “Đơn của tôi đang ở đâu?”

Hướng dẫn người mới: “Làm sao để mua?”, “Đăng ký tài khoản ở đâu?”

Gợi ý đọc bài viết phù hợp từ blog

Tương tác thân thiện, tự nhiên, nhanh nhẹn và chính xác.";
$defaultLanguage = 'vi';

// Khởi tạo session nếu chưa có
if (!isset($_SESSION['history'])) $_SESSION['history'] = [];
if (!isset($_SESSION['learned_data'])) $_SESSION['learned_data'] = '';
if (!isset($_SESSION['language'])) $_SESSION['language'] = $defaultLanguage;
if (!isset($_SESSION['intro'])) $_SESSION['intro'] = $defaultIntro;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['message'])) {
        $userMessage = trim($_POST['message']);
        $redirectKeywords = [
            'trang chủ' => 'http://localhost/agri-ecommerce/index.php',
            'mua hàng' => 'http://localhost/agri-ecommerce/shop',
            'giỏ hàng' => 'http://localhost/agri-ecommerce/cart',
            'liên hệ'  => 'http://localhost/agri-ecommerce/contact',
            'trái cây' => 'http://localhost/agri-ecommerce/category&id=19',
            'rau củ' => 'http://localhost/agri-ecommerce/category&id=20',
            'thịt cá' => 'http://localhost/agri-ecommerce/category&id=21',
            'đóng hộp' => 'http://localhost/agri-ecommerce/category&id=22', 
        ];

        foreach ($redirectKeywords as $keyword => $url) {
            if (stripos($userMessage, $keyword) !== false) {
                $_SESSION['history'][] = ['role' => 'user', 'content' => $userMessage];
                $_SESSION['history'][] = [
                    'role' => 'assistant',
                    'content' => "🔗 Bạn có thể truy cập <a href='$url' target='_blank'><strong>$keyword</strong></a> tại đây."
                ];
                
                return;
            }
        }

        $_SESSION['history'][] = ['role' => 'user', 'content' => $userMessage];

        $messages = [
            ['role' => 'system', 'content' => $_SESSION['intro'] . "\n" . $_SESSION['learned_data']],
            ...$_SESSION['history']
        ];

        $data = ['model' => 'gpt-3.5-turbo', 'messages' => $messages];

        $ch = curl_init('https://api.yescale.io/v1/chat/completions');
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer $apiKey"
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $resData = json_decode($response, true);
            $reply = $resData['choices'][0]['message']['content'] ?? '';
            $_SESSION['history'][] = ['role' => 'assistant', 'content' => $reply];
        }
    }

    if (isset($_FILES['fileUpload'])) {
        $file = $_FILES['fileUpload'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $file['tmp_name'];
            $mimeType = mime_content_type($tmpPath);

            if (strpos($mimeType, 'text/') === 0) {
                $content = file_get_contents($tmpPath);
                $_SESSION['learned_data'] .= "\n" . $content;
                $_SESSION['history'][] = ['role' => 'assistant', 'content' => '📄 Đã lưu nội dung văn bản.'];
            } elseif (strpos($mimeType, 'image/') === 0) {
                $savedPath = 'uploads/' . basename($file['name']);
                if (!is_dir('uploads')) mkdir('uploads');
                move_uploaded_file($tmpPath, $savedPath);
                $ocrText = shell_exec("tesseract " . escapeshellarg($savedPath) . " stdout");
                $_SESSION['learned_data'] .= "\n" . $ocrText;
                $_SESSION['history'][] = ['role' => 'assistant', 'content' => "🖼 Văn bản từ ảnh: $ocrText"];
            }
        }
    }

    if (isset($_POST['reset'])) {
        unset($_SESSION['history'], $_SESSION['learned_data']);
        $_SESSION['language'] = $defaultLanguage;
        $_SESSION['intro'] = $defaultIntro;
        $_SESSION['history'][] = ["role" => "assistant", "content" => "🔄 Đã đặt lại cuộc trò chuyện, xóa dữ liệu học và khôi phục cấu hình mặc định."];
    }
}
?>

<!-- CSS Bong Bóng Chat + Khung -->
<style>
    .chatbot-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 24px;
    cursor: pointer;
    z-index: 999;
}

.chatbot-window {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 470px;
    height: 530px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    z-index: 999;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-inner {
    display: flex;
    flex-direction: column;
    flex: 1;
    height: 100%;
    background-color: #eef1f7;
}

.chat-header {
    text-align: center;
    font-weight: bold;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
    background-color: #fff;
}

.chat {
    flex: 1;
    overflow-y: auto;
    background: #fdfdfd;
    border-bottom: 1px solid #ddd;
    padding: 10px;
}

.message {
    margin: 10px 0;
    padding: 10px;
    border-radius: 10px;
    max-width: 80%;
    clear: both;
    word-wrap: break-word;
}

.user {
    background-color: #28a745;
    color: white;
    float: right;
    text-align: right;
}

.assistant {
    background-color: #e1e1e1;
    float: left;
}

.chat-input-area {
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ddd;
}

.chat-form {
    display: flex;
    gap: 5px;
    align-items: center;
}

.chat-form input[type="text"] {
    flex: 1;
    padding: 6px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.chat-form button {
    padding: 6px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #28a745;
    color: white;
    font-size: 14px;
}

.upload-btn {
    background-color:rgb(255, 255, 255);
}

.send-btn {
    background-color: #28a745;
}

.reset-form {
    margin-top: 5px;
    text-align: center;
}

.reset-btn {
    background-color: #28a745;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

</style>

<!-- Button mở chatbot -->
<button class="chatbot-button" onclick="toggleChatbot()">💬</button>

<div class="chatbot-window" id="chatbotWindow">
    <div class="chat-inner">
        <div class="chat-header">ChatAI-5.0</div>
        
        <div class="chat">
            <?php foreach ($_SESSION['history'] as $msg): ?>
                <?php if ($msg['role'] === 'assistant'): ?>
                    <div class="message assistant"><?= nl2br($msg['content']) ?></div>
                <?php else: ?>
                    <div class="message user"><?= nl2br(htmlspecialchars($msg['content'])) ?></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="chat-input-area">
            <form id="chatForm" enctype="multipart/form-data" class="chat-form">
                <input type="text" name="message" id="messageInput" placeholder="Nhập tin nhắn..." required>
                <button type="button" onclick="document.getElementById('fileUpload').click()">📎</button>
                <input type="file" name="fileUpload" id="fileUpload" style="display:none;">
                <button type="submit">Gửi</button>
            </form>
            <form id="resetForm" method="post" class="reset-form">
                <button type="submit" name="reset" class="reset-btn">🔄 Reset</button>
            </form>
        </div>
    </div>
</div>


<script>
    function toggleChatbot() {
        const chat = document.getElementById("chatbotWindow");
        chat.style.display = chat.style.display === "block" ? "none" : "block";
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function toggleChatbot() {
    const chat = document.getElementById("chatbotWindow");
    chat.style.display = chat.style.display === "block" ? "none" : "block";
}

$(document).ready(function () {
    // Gửi tin nhắn
    $('#chatForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: '',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                $('#messageInput').val('');
                loadChat();
            }
        });
    });

    // Tải file
    $('#fileUpload').on('change', function () {
        const formData = new FormData($('#chatForm')[0]);
        $.ajax({
            url: '',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                $('#fileUpload').val('');
                loadChat();
            }
        });
    });

    // Reset chat
    $('#resetForm').on('submit', function (e) {
        e.preventDefault();
        $.post('', { reset: true }, function () {
            loadChat();
        });
    });

    // Cuộn xuống cuối khi nạp lại chat
    function loadChat() {
        $('.chat').load(location.href + ' .chat > *', function () {
            const chatBox = document.querySelector('.chat');
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    }

    // Gọi luôn khi mở trang
    loadChat();
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>   
<!-- JS toggle -->

<script>
    function toggleChatbot() {
        const chat = document.getElementById("chatbotWindow");
        chat.style.display = chat.style.display === "block" ? "none" : "block";
    }
</script>
