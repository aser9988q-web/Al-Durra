
<?php
// بيانات الاتصال بقاعدة البيانات TiDB على Railway
$DB_HOST = 'gateway05.us-east-1.prod.aws.tidbcloud.com';
$DB_USER = '2Vvfr16QWWftd7K.6aead7d502f2';
$DB_PASSWORD = 'ab1YUrd4jAd5k7msZ0o7';
$DB_NAME = 'U9uGjVApfvDHafaNLjxFrP';
$DB_PORT = 4000;

// إنشاء الاتصال
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

// التحقق من الاتصال
if (!$con) {
    error_log("Database Connection Error: " . mysqli_connect_error());
    die("خطأ في الاتصال بقاعدة البيانات. يرجى المحاولة لاحقاً.");
}

// تعيين الترميز
mysqli_set_charset($con, "utf8mb4");
?>