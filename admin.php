<?php
session_start();
require_once('./DB_CON.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['admin_logged_in'])) {
    // إذا كان هناك محاولة دخول
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // بيانات الإدمن الافتراضية
        $admin_username = 'admin';
        $admin_password = 'admin123'; // يجب تغييرها في الإنتاج
        
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            $error = 'بيانات دخول غير صحيحة';
        }
    }
    
    // عرض صفحة تسجيل الدخول
    ?>
    <!DOCTYPE html>
    <html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>لوحة الإدمن - الدرة</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            * {
                font-family: "Cairo", sans-serif;
                direction: rtl;
            }
            body {
                background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-container {
                background: white;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                padding: 40px;
                max-width: 400px;
                width: 100%;
            }
            .login-container h1 {
                color: #691E7C;
                margin-bottom: 30px;
                text-align: center;
                font-weight: bold;
            }
            .form-control {
                border: 2px solid #e0e0e0;
                border-radius: 5px;
                padding: 10px 15px;
                margin-bottom: 15px;
            }
            .form-control:focus {
                border-color: #691E7C;
                box-shadow: 0 0 0 0.2rem rgba(105, 30, 124, 0.25);
            }
            .btn-login {
                background-color: #691E7C;
                border: none;
                padding: 10px 20px;
                font-weight: bold;
                width: 100%;
                border-radius: 5px;
            }
            .btn-login:hover {
                background-color: #8B3A9C;
            }
            .alert {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>🔐 لوحة الإدمن</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">اسم المستخدم</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login">دخول</button>
            </form>
            <hr>
            <p style="text-align: center; color: #666; font-size: 12px;">
                بيانات الاختبار:<br>
                المستخدم: admin<br>
                كلمة المرور: admin123
            </p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// معالجة تسجيل الخروج
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// معالجة القبول والرفض
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $appointment_id = $_POST['appointment_id'] ?? '';
    
    if ($action && $appointment_id) {
        $status = ($action === 'approve') ? 'approved' : 'rejected';
        $stmt = $con->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $appointment_id);
        $stmt->execute();
        $stmt->close();
        
        // إعادة تحميل الصفحة
        header('Location: admin.php');
        exit;
    }
}

// جلب الإحصائيات من قاعدة البيانات
$stats = [
    'orders' => 0,
    'users' => 0,
    'appointments' => 0,
    'pending_appointments' => 0,
    'approved_appointments' => 0,
    'rejected_appointments' => 0,
    'total_payments' => 0
];

try {
    // عدد الطلبات
    $result = $con->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['orders'] = $row['count'] ?? 0;
    }
    
    // عدد المستخدمين
    $result = $con->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['users'] = $row['count'] ?? 0;
    }
    
    // عدد المواعيد
    $result = $con->query("SELECT COUNT(*) as count FROM appointments");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['appointments'] = $row['count'] ?? 0;
    }
    
    // المواعيد المعلقة
    $result = $con->query("SELECT COUNT(*) as count FROM appointments WHERE status='pending'");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['pending_appointments'] = $row['count'] ?? 0;
    }
    
    // المواعيد المقبولة
    $result = $con->query("SELECT COUNT(*) as count FROM appointments WHERE status='approved'");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['approved_appointments'] = $row['count'] ?? 0;
    }
    
    // المواعيد المرفوضة
    $result = $con->query("SELECT COUNT(*) as count FROM appointments WHERE status='rejected'");
    if ($result) {
        $row = $result->fetch_assoc();
        $stats['rejected_appointments'] = $row['count'] ?? 0;
    }
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
}

// جلب المواعيد المعلقة
$pending_appointments = [];
$result = $con->query("
    SELECT a.id, a.nationality, a.service, a.start_date, a.duration, a.status,
           u.name, u.phone, u.address
    FROM appointments a
    JOIN users u ON a.user_id = u.id
    WHERE a.status = 'pending'
    ORDER BY a.id DESC
    LIMIT 50
");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pending_appointments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدمن - الدرة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * {
            font-family: "Cairo", sans-serif;
            direction: rtl;
        }
        body {
            background-color: #f5f5f5;
        }
        .sidebar {
            background-color: #691E7C;
            min-height: 100vh;
            padding: 20px;
            color: white;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #8B3A9C;
        }
        .sidebar a.active {
            background-color: #fff;
            color: #691E7C;
            font-weight: bold;
        }
        .main-content {
            padding: 20px;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            color: #691E7C;
            margin: 0;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-card h3 {
            color: #691E7C;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .stat-card .number {
            font-size: 32px;
            color: #8B3A9C;
            font-weight: bold;
        }
        .stat-card .icon {
            font-size: 40px;
            color: #691E7C;
            margin-bottom: 10px;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 2px;
        }
        .btn-approve:hover {
            background-color: #218838;
        }
        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 2px;
        }
        .btn-reject:hover {
            background-color: #c82333;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- الشريط الجانبي -->
            <div class="col-md-3 sidebar">
                <h2>🏢 الدرة</h2>
                <a href="admin.php" class="active"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="#appointments"><i class="fas fa-calendar"></i> المواعيد</a>
                <a href="#users"><i class="fas fa-users"></i> المستخدمون</a>
                <a href="#payments"><i class="fas fa-credit-card"></i> الدفعات</a>
                <hr>
                <a href="admin.php?logout=true"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
            </div>
            
            <!-- المحتوى الرئيسي -->
            <div class="col-md-9 main-content">
                <div class="header">
                    <div>
                        <h1>مرحباً بك في لوحة الإدمن</h1>
                        <p style="color: #666; margin: 0;">أهلاً بك، <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
                    </div>
                    <div>
                        <span style="color: #666;">آخر تحديث: <?php echo date('Y-m-d H:i:s'); ?></span>
                    </div>
                </div>
                
                <!-- الإحصائيات -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <h3>إجمالي المستخدمين</h3>
                            <div class="number"><?php echo $stats['users']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-calendar"></i></div>
                            <h3>إجمالي المواعيد</h3>
                            <div class="number"><?php echo $stats['appointments']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-clock" style="color: #ffc107;"></i></div>
                            <h3>مواعيد معلقة</h3>
                            <div class="number" style="color: #ffc107;"><?php echo $stats['pending_appointments']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-check" style="color: #28a745;"></i></div>
                            <h3>مواعيد مقبولة</h3>
                            <div class="number" style="color: #28a745;"><?php echo $stats['approved_appointments']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-times" style="color: #dc3545;"></i></div>
                            <h3>مواعيد مرفوضة</h3>
                            <div class="number" style="color: #dc3545;"><?php echo $stats['rejected_appointments']; ?></div>
                        </div>
                    </div>
                </div>

                <!-- جدول المواعيد المعلقة -->
                <div class="table-container mt-4">
                    <h3 style="color: #691E7C; margin-bottom: 20px;">
                        <i class="fas fa-list"></i> المواعيد المعلقة (<?php echo count($pending_appointments); ?>)
                    </h3>
                    
                    <?php if (count($pending_appointments) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background-color: #691E7C; color: white;">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم العميل</th>
                                        <th>الهاتف</th>
                                        <th>الجنسية</th>
                                        <th>الخدمة</th>
                                        <th>تاريخ البدء</th>
                                        <th>الحالة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pending_appointments as $index => $appointment): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['nationality']); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['service']); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['start_date']); ?></td>
                                            <td>
                                                <span class="status-badge status-pending">
                                                    معلق
                                                </span>
                                            </td>
                                            <td>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                                    <button type="submit" name="action" value="approve" class="btn-approve">
                                                        <i class="fas fa-check"></i> قبول
                                                    </button>
                                                    <button type="submit" name="action" value="reject" class="btn-reject">
                                                        <i class="fas fa-times"></i> رفض
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> لا توجد مواعيد معلقة حالياً
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
