<?php


// Kết nối MySQL

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "account_db"
);


// Kiểm tra kết nối

if ($conn->connect_error) {

    die("Lỗi kết nối database");
}



// Nhận dữ liệu JSON từ JavaScript

$data = json_decode(
    file_get_contents("php://input"),
    true
);



$username = $data["username"];

$email = $data["email"];

$password = $data["password"];



// Mã hóa mật khẩu

$password = password_hash(
    $password,
    PASSWORD_DEFAULT
);



// Lưu vào MySQL

$sql = "
INSERT INTO users
(username,email,password)

VALUES
('$username',
 '$email',
 '$password')
";



if ($conn->query($sql)) {

    echo "Đăng ký thành công";
} else {

    echo "Có lỗi xảy ra";
}


$conn->close();
