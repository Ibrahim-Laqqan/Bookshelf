<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (!empty($name) && !empty($email) && !empty($message)) {
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // إذا تم الحفظ بنجاح → التوجيه لصفحة indexAR.html
        header("Location: ../indexAR.html");
        exit();
    } else {
        echo "خطأ في حفظ البيانات: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "يرجى ملء جميع الحقول.";
}

$conn->close();
?>