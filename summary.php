<?php
session_start();
require_once('./DB_CON.php');

// التحقق من وجود بيانات المستخدم
if (!isset($_SESSION['user_id'])) {
    header('Location: appointment.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// جلب بيانات المستخدم
$user_data = [];
$stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}
$stmt->close();

// جلب بيانات الموعد
$appointment_data = [];
$stmt = $con->prepare("SELECT * FROM appointments WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $appointment_data = $result->fetch_assoc();
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <title>الدرة - ملخص الموعد</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            font-family: "Cairo", sans-serif;
            color: #691E7C;
            direction: rtl;
        }
        body {
            background-color: #f8f9fa;
        }
        .nav {
            background-image: url(./assets/menu_bg\ \(1\).avif);
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
        }
        .nav img {
            width: 230px;
        }
        .summary-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .summary-card h2 {
            color: #691E7C;
            margin-bottom: 20px;
            font-weight: bold;
            border-bottom: 3px solid #e7b604;
            padding-bottom: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .summary-row:last-child {
            border-bottom: none;
        }
        .summary-label {
            font-weight: bold;
            color: #691E7C;
        }
        .summary-value {
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .status-pending {
            background-color: #ffc107;
            color: black;
        }
        .status-approved {
            background-color: #28a745;
            color: white;
        }
        .status-rejected {
            background-color: #dc3545;
            color: white;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 20px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-primary-custom {
            background-color: #691E7C;
            color: white;
        }
        .btn-primary-custom:hover {
            background-color: #8B3A9C;
            color: white;
        }
        .btn-secondary-custom {
            background-color: #e7b604;
            color: #691E7C;
        }
        .btn-secondary-custom:hover {
            background-color: #d4a503;
            color: #691E7C;
        }
        .success-icon {
            text-align: center;
            margin-bottom: 20px;
        }
        .success-icon i {
            font-size: 60px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <nav class="nav">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" alt="الدرة">
    </nav>

    <div class="container mt-5 mb-5">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
            <h3 style="margin-top: 10px;">تم استقبال طلبك بنجاح!</h3>
        </div>

        <!-- ملخص بيانات العميل -->
        <div class="summary-card">
            <h2><i class="fas fa-user"></i> بيانات العميل</h2>
            <div class="summary-row">
                <span class="summary-label">اسم العميل:</span>
                <span class="summary-value"><?php echo htmlspecialchars($user_data['name'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">رقم المدني:</span>
                <span class="summary-value"><?php echo htmlspecialchars($user_data['ssn'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">رقم الهاتف:</span>
                <span class="summary-value"><?php echo htmlspecialchars($user_data['phone'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">العنوان:</span>
                <span class="summary-value"><?php echo htmlspecialchars($user_data['address'] ?? 'غير متوفر'); ?></span>
            </div>
        </div>

        <!-- ملخص بيانات الموعد -->
        <div class="summary-card">
            <h2><i class="fas fa-calendar"></i> بيانات الموعد</h2>
            <div class="summary-row">
                <span class="summary-label">الجنسية:</span>
                <span class="summary-value"><?php echo htmlspecialchars($appointment_data['nationality'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">نوع الخدمة:</span>
                <span class="summary-value"><?php echo htmlspecialchars($appointment_data['service'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">تاريخ البدء:</span>
                <span class="summary-value"><?php echo htmlspecialchars($appointment_data['start_date'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">مدة الخدمة:</span>
                <span class="summary-value"><?php echo htmlspecialchars($appointment_data['duration'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">ساعة الاستلام:</span>
                <span class="summary-value"><?php echo htmlspecialchars($appointment_data['pickup_time'] ?? 'غير متوفر'); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">الجنس:</span>
                <span class="summary-value">
                    <?php 
                    $gender = $appointment_data['gender'] ?? '';
                    echo ($gender === '1') ? 'أنثى' : (($gender === '2') ? 'ذكر' : 'غير متوفر');
                    ?>
                </span>
            </div>
            <div class="summary-row">
                <span class="summary-label">طريقة الاستلام:</span>
                <span class="summary-value">
                    <?php 
                    $method = $appointment_data['method'] ?? '';
                    echo ($method === '1') ? 'مندوب التوصيل' : (($method === '2') ? 'مقر الشركة' : 'غير متوفر');
                    ?>
                </span>
            </div>
            <div class="summary-row">
                <span class="summary-label">حالة الطلب:</span>
                <span class="summary-value">
                    <?php 
                    $status = $appointment_data['status'] ?? 'pending';
                    if ($status === 'pending') {
                        echo '<span class="status-badge status-pending">معلق - قيد المراجعة</span>';
                    } elseif ($status === 'approved') {
                        echo '<span class="status-badge status-approved">✓ مقبول</span>';
                    } elseif ($status === 'rejected') {
                        echo '<span class="status-badge status-rejected">✗ مرفوض</span>';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- معلومات إضافية -->
        <div class="summary-card">
            <h2><i class="fas fa-info-circle"></i> معلومات مهمة</h2>
            <p style="color: #666; line-height: 1.8;">
                شكراً لاختيارك خدماتنا! تم استقبال طلبك وسيتم مراجعته من قبل فريقنا.<br>
                <br>
                <strong>سيتم التواصل معك على رقم الهاتف المسجل لتأكيد الطلب والموافقة عليه.</strong><br>
                <br>
                إذا كان لديك أي استفسارات، يرجى التواصل معنا على الأرقام المتاحة.
            </p>
        </div>

        <!-- الأزرار -->
        <div class="button-group">
            <a href="appointment.php" class="btn-custom btn-secondary-custom">
                <i class="fas fa-arrow-right"></i> حجز موعد جديد
            </a>
            <a href="index.php" class="btn-custom btn-primary-custom">
                <i class="fas fa-home"></i> العودة للرئيسية
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>