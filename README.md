# Hướng dẫn sử dụng Sass

## Cài đặt Sass
Chạy lệnh sau để cài đặt Sass toàn cục (nếu chưa có):
```bash
npm install -g sass
```

## Generate CSS từ Sass
Sử dụng lệnh sau để biên dịch file `.scss` thành `.css`:
```bash
sass -w 'public/sass/style.scss':'public/css/style.css'
```

Bạn có thể viết style như bình thường trong các file `.scss`.

## Lưu ý khi commit
Trước khi commit, hãy xóa các file sau:
- `style.css`
- `style.css.map`