<?php
session_start();

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

// إذا كان المستخدم مسجل دخول، عرض لوحة الإدمن
include 'DB_CON.php';

// معالجة تسجيل الخروج
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// جلب الإحصائيات
$stats = [];

// عدد الطلبات
$result = $conn->query("SELECT COUNT(*) as count FROM orders");
$stats['orders'] = $result->fetch_assoc()['count'] ?? 0;

// عدد المستخدمين
$result = $conn->query("SELECT COUNT(*) as count FROM users");
$stats['users'] = $result->fetch_assoc()['count'] ?? 0;

// عدد المواعيد
$result = $conn->query("SELECT COUNT(*) as count FROM appointments");
$stats['appointments'] = $result->fetch_assoc()['count'] ?? 0;

// إجمالي الدفعات
$result = $conn->query("SELECT SUM(amount) as total FROM payments WHERE status='completed'");
$stats['total_payments'] = $result->fetch_assoc()['total'] ?? 0;
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
            font-size: 24px;
            margin: 10px 0;
        }
        .stat-card p {
            color: #666;
            margin: 0;
        }
        .stat-icon {
            font-size: 40px;
            color: #691E7C;
            margin-bottom: 10px;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            color: #691E7C;
            margin: 0;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #691E7C;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- الشريط الجانبي -->
            <div class="col-md-3 sidebar">
                <h2 style="margin-bottom: 30px;">🏢 الدرة</h2>
                <a href="admin.php" class="active">
                    <i class="fas fa-home"></i> لوحة التحكم
                </a>
                <a href="admin.php?page=orders">
                    <i class="fas fa-shopping-cart"></i> الطلبات
                </a>
                <a href="admin.php?page=users">
                    <i class="fas fa-users"></i> المستخدمون
                </a>
                <a href="admin.php?page=appointments">
                    <i class="fas fa-calendar"></i> المواعيد
                </a>
                <a href="admin.php?page=payments">
                    <i class="fas fa-credit-card"></i> الدفعات
                </a>
                <hr style="border-color: rgba(255,255,255,0.3);">
                <a href="admin.php?logout=true" class="logout-btn" style="text-align: center;">
                    <i class="fas fa-sign-out-alt"></i> تسجيل خروج
                </a>
            </div>

            <!-- المحتوى الرئيسي -->
            <div class="col-md-9 main-content">
                <!-- رأس الصفحة -->
                <div class="header">
                    <h1>مرحباً بك في لوحة التحكم</h1>
                    <span>المستخدم: <strong><?php echo $_SESSION['admin_username']; ?></strong></span>
                </div>

                <?php
                $page = $_GET['page'] ?? 'dashboard';

                if ($page === 'dashboard') {
                    ?>
                    <!-- الإحصائيات -->
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h3><?php echo $stats['orders']; ?></h3>
                                <p>إجمالي الطلبات</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3><?php echo $stats['users']; ?></h3>
                                <p>إجمالي المستخدمين</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <h3><?php echo $stats['appointments']; ?></h3>
                                <p>إجمالي المواعيد</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h3><?php echo number_format($stats['total_payments'], 2); ?> د.ك</h3>
                                <p>إجمالي الدفعات</p>
                            </div>
                        </div>
                    </div>

                    <!-- آخر الطلبات -->
                    <div class="table-container">
                        <h3 style="color: #691E7C; margin-bottom: 20px;">📋 آخر الطلبات</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>العميل</th>
                                    <th>الخدمة</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT 10");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>#" . $row['id'] . "</td>";
                                        echo "<td>" . $row['customer_name'] . "</td>";
                                        echo "<td>" . $row['service_type'] . "</td>";
                                        echo "<td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>";
                                        echo "<td><span class='badge bg-success'>" . $row['status'] . "</span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>لا توجد طلبات</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <?php
                } elseif ($page === 'orders') {
                    ?>
                    <div class="table-container">
                        <h3 style="color: #691E7C; margin-bottom: 20px;">📋 جميع الطلبات</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>العميل</th>
                                    <th>الخدمة</th>
                                    <th>المبلغ</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>#" . $row['id'] . "</td>";
                                        echo "<td>" . $row['customer_name'] . "</td>";
                                        echo "<td>" . $row['service_type'] . "</td>";
                                        echo "<td>" . $row['amount'] . " د.ك</td>";
                                        echo "<td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>";
                                        echo "<td><span class='badge bg-success'>" . $row['status'] . "</span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center text-muted'>لا توجد طلبات</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } elseif ($page === 'users') {
                    ?>
                    <div class="table-container">
                        <h3 style="color: #691E7C; margin-bottom: 20px;">👥 المستخدمون</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>رقم المستخدم</th>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الهاتف</th>
                                    <th>تاريخ التسجيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM users ORDER BY id DESC");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>#" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>لا يوجد مستخدمون</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } elseif ($page === 'appointments') {
                    ?>
                    <div class="table-container">
                        <h3 style="color: #691E7C; margin-bottom: 20px;">📅 المواعيد</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>رقم الموعد</th>
                                    <th>العميل</th>
                                    <th>التاريخ والوقت</th>
                                    <th>الخدمة</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM appointments ORDER BY appointment_date DESC");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>#" . $row['id'] . "</td>";
                                        echo "<td>" . $row['customer_name'] . "</td>";
                                        echo "<td>" . date('Y-m-d H:i', strtotime($row['appointment_date'])) . "</td>";
                                        echo "<td>" . $row['service_type'] . "</td>";
                                        echo "<td><span class='badge bg-warning'>" . $row['status'] . "</span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>لا توجد مواعيد</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } elseif ($page === 'payments') {
                    ?>
                    <div class="table-container">
                        <h3 style="color: #691E7C; margin-bottom: 20px;">💳 الدفعات</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>رقم الدفعة</th>
                                    <th>العميل</th>
                                    <th>المبلغ</th>
                                    <th>طريقة الدفع</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM payments ORDER BY id DESC");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $status_badge = $row['status'] === 'completed' ? 'bg-success' : 'bg-danger';
                                        echo "<tr>";
                                        echo "<td>#" . $row['id'] . "</td>";
                                        echo "<td>" . $row['customer_name'] . "</td>";
                                        echo "<td>" . $row['amount'] . " د.ك</td>";
                                        echo "<td>" . $row['payment_method'] . "</td>";
                                        echo "<td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>";
                                        echo "<td><span class='badge " . $status_badge . "'>" . $row['status'] . "</span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center text-muted'>لا توجد دفعات</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
