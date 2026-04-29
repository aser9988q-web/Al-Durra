<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once('./DB_CON.php');

// معالجة البيانات عند الإرسال
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // التحقق من البيانات المطلوبة
    $name = $_POST['name'] ?? '';
    $ssn = $_POST['ssn'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $elec = $_POST['elec'] ?? '';
    
    // البيانات من صفحة appointment
    $nationality = $_POST['nationality'] ?? '';
    $service = $_POST['service'] ?? '';
    $startDate = $_POST['startDate'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $pickupTime = $_POST['pickupTime'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $method = $_POST['method'] ?? '';
    
    // التحقق من البيانات المطلوبة
    if (empty($name) || empty($ssn) || empty($phone) || empty($address)) {
        $error = 'يرجى ملء جميع البيانات المطلوبة';
    } else {
        // حفظ البيانات في قاعدة البيانات
        try {
            // حفظ بيانات المستخدم
            $stmt = $con->prepare("INSERT INTO users (name, ssn, phone, address, extra) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $ssn, $phone, $address, $elec);
            $stmt->execute();
            $user_id = $stmt->insert_id;
            $stmt->close();
            
            // حفظ بيانات الموعد
            $stmt = $con->prepare("INSERT INTO appointments (user_id, nationality, service, start_date, duration, pickup_time, gender, method, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
            $stmt->bind_param("isssssss", $user_id, $nationality, $service, $startDate, $duration, $pickupTime, $gender, $method);
            $stmt->execute();
            $stmt->close();
            
            // حفظ البيانات في الجلسة
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['appointment_id'] = $con->insert_id;
            
            // إعادة التوجيه إلى صفحة الملخص
            header('Location: summary.php');
            exit;
        } catch (Exception $e) {
            $error = 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage();
        }
    }
}

// إذا لم تكن هناك بيانات من appointment، إعادة التوجيه
if (!isset($_POST['nationality'])) {
    header('Location: appointment.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <title>الدرة - بيانات العميل</title>
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
        .form-control {
            border-radius: 15px !important;
        }
        .btn-primary {
            background-color: #691E7C !important;
            border: none;
        }
        .alert {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <nav class="nav">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" alt="الدرة">
    </nav>

    <h6 class="mx-4 mt-4 text-center alert alert-primary" style="border-radius: 15px; padding:10px">
        عملائنا يرجى التحقق من أن جميع البيانات المدخلة <br> بإسم العميل المتقدم على الحجز
    </h6>

    <div class="container mt-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="row px-3">
                <!-- بيانات العميل -->
                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-person-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="name" class="text-secondary mb-2">اسم العميل كامل *</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-file-earmark-bar-graph-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="ssn" class="text-secondary mb-2">رقم المدني لصاحب المعاملة *</label>
                        <input type="text" class="form-control" name="ssn" id="ssn" minlength="12" maxlength="12" pattern="[0-9]*" inputmode="numeric" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-telephone-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="phone" class="text-secondary mb-2">رقم النقال *</label>
                        <input type="text" class="form-control" name="phone" id="phone" minlength="8" maxlength="10" pattern="[0-9]*" inputmode="numeric" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-geo-alt fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="address" class="text-secondary mb-2">العنوان *</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-calendar-check-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="elec" class="text-secondary mb-2">رقم الآلي للعنوان</label>
                        <input type="text" class="form-control" name="elec" id="elec">
                    </div>
                </div>

                <!-- بيانات الموعد المخفية -->
                <input type="hidden" name="nationality" value="<?php echo htmlspecialchars($_POST['nationality'] ?? ''); ?>">
                <input type="hidden" name="service" value="<?php echo htmlspecialchars($_POST['service'] ?? ''); ?>">
                <input type="hidden" name="startDate" value="<?php echo htmlspecialchars($_POST['startDate'] ?? ''); ?>">
                <input type="hidden" name="duration" value="<?php echo htmlspecialchars($_POST['duration'] ?? ''); ?>">
                <input type="hidden" name="pickupTime" value="<?php echo htmlspecialchars($_POST['pickupTime'] ?? ''); ?>">
                <input type="hidden" name="gender" value="<?php echo htmlspecialchars($_POST['gender'] ?? ''); ?>">
                <input type="hidden" name="method" value="<?php echo htmlspecialchars($_POST['method'] ?? ''); ?>">
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="w-50 btn btn-primary py-2 mt-4 mb-5" style="border-radius: 20px;">متابعة</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
