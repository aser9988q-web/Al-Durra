<?php
// بيانات الاتصال بقاعدة البيانات TiDB على Railway
$DB_HOST = 'gateway05.us-east-1.prod.aws.tidbcloud.com';
$DB_USER = '2Vvfr16QWWftd7K.6aead7d502f2';
$DB_PASSWORD = 'ab1YUrd4jAd5k7msZ0o7';
$DB_NAME = 'U9uGjVApfvDHafaNLjxFrP';
$DB_PORT = 4000;

// إنشاء الاتصال مع SSL
$con = mysqli_init();

// تفعيل SSL
mysqli_options($con, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// الاتصال
if (!mysqli_real_connect($con, $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT)) {
    error_log("Database Connection Error: " . mysqli_connect_error());
    die("خطأ في الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// تعيين الترميز
mysqli_set_charset($con, "utf8mb4");

// اختبار الاتصال
if (!$con->ping()) {
    error_log("Database Ping Error: " . $con->error);
    die("خطأ في الاتصال بقاعدة البيانات. يرجى المحاولة لاحقاً.");
}
?>
