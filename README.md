# Hướng Dẫn Sử Dụng Dự Án Ban Điện Thoại MVC

Chào mừng bạn đến với dự án **Ban Điện Thoại MVC**! Đây là một dự án được xây dựng theo kiến trúc MVC (Model-View-Controller) nhằm quản lý và bán điện thoại trực tuyến. Trong tài liệu này, chúng ta sẽ cùng nhau tìm hiểu cách thiết lập dự án, cấu trúc thư mục, quy trình làm việc MVC, các tính năng của dự án, hướng dẫn khắc phục sự cố và mẹo học tập.

## 1. Thiết Lập Dự Án
Để thiết lập dự án này trên máy tính cá nhân của bạn, hãy làm theo các bước sau:

### Bước 1: Cloning Repository
Mở terminal và chạy lệnh:
```bash
git clone https://github.com/<username>/ban-dien-thoai-mvc.git
```

### Bước 2: Cài Đặt Các Thư Viện Cần Thiết
Di chuyển vào thư mục dự án và cài đặt các thư viện bằng npm:
```bash
cd ban-dien-thoai-mvc
npm install
```

### Bước 3: Chạy Dự Án
Sau khi cài đặt xong, bạn có thể chạy dự án bằng lệnh:
```bash
npm start
```
Mở trình duyệt và truy cập `http://localhost:3000` để xem ứng dụng.

## 2. Cấu Trúc Thư Mục

Dưới đây là cấu trúc thư mục của dự án:
```
ban-dien-thoai-mvc/
├── controllers/
│   └── phoneController.js
├── models/
│   └── phoneModel.js
├── views/
│   └── phoneView.ejs
├── routes/
│   └── phoneRoutes.js
├── public/
│   └── images/
└── app.js
```
- **controllers/**: Chứa các controller xử lý logic của ứng dụng.
- **models/**: Chứa các mô hình đại diện cho dữ liệu.
- **views/**: Chứa các file giao diện người dùng.
- **routes/**: Định nghĩa các route của ứng dụng.
- **public/**: Chứa các tài nguyên công khai như hình ảnh.
- **app.js**: File chính để khởi động ứng dụng.

## 3. Quy Trình Làm Việc MVC
Quy trình MVC giúp phân tách các phần của ứng dụng:
1. **Model**: Quản lý dữ liệu và logic ứng dụng.
2. **View**: Đảm nhiệm việc hiển thị thông tin cho người dùng.
3. **Controller**: Nắm giữ các lệnh từ người dùng, tương tác với Model và cập nhật View tương ứng.

## 4. Các Tính Năng
Dự án này có những tính năng chính sau:
- Hiển thị danh sách các điện thoại có sẵn.
- Chi tiết thông tin cho từng điện thoại.
- Thêm, sửa và xóa điện thoại trong danh sách.

## 5. Hướng Dẫn Khắc Phục Sự Cố
Nếu gặp vấn đề khi chạy ứng dụng:
- Đảm bảo rằng bạn đã cài đặt Node.js và npm.
- Kiểm tra xem các thư viện đã được cài đặt thành công chưa bằng lệnh `npm install`.
- Xem lại các thông báo lỗi trong terminal để xác định nguyên nhân.

## 6. Mẹo Học Tập
- Đọc tài liệu về MVC để hiểu rõ hơn về cách hoạt động của ứng dụng.
- Thực hành viết mã bằng cách tự ý thêm các tính năng mới.
- Tham gia các cộng đồng lập trình để trao đổi kinh nghiệm.

Hy vọng tài liệu này sẽ giúp bạn bắt đầu với dự án Ban Điện Thoại MVC một cách dễ dàng và hiệu quả!