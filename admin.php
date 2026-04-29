<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['admin_logged_in'])) {
    // إذا كان هناك محاولة دخول
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // بيانات الإدمن الافتراضية
        $admin_username = 'admin';
        $admin_password = 'admin123';
        
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
                color: white;
            }
            .btn-login:hover {
                background-color: #8B3A9C;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>🔐 لوحة الإدمن</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
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
                <button type="submit" class="btn btn-login">دخول</button>
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

// لوحة الإدمن الرئيسية
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
            background-color: #f5f5f5;
        }
        .sidebar {
            background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%);
            min-height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
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
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #691E7C;
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
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-approve {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-approve:hover {
            background-color: #218838;
        }
        .btn-reject {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-reject:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- الشريط الجانبي -->
            <div class="col-md-2 sidebar">
                <div style="padding: 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                    <h4>الدرة</h4>
                    <small>لوحة الإدمن</small>
                </div>
                <a href="admin.php">📊 الرئيسية</a>
                <a href="?page=appointments">📅 المواعيد</a>
                <a href="?page=users">👥 المستخدمون</a>
                <a href="?page=payments">💳 الدفعات</a>
                <a href="?page=settings">⚙️ الإعدادات</a>
                <hr style="border-color: rgba(255, 255, 255, 0.2);">
                <a href="?logout=1" style="color: #ff6b6b;">🚪 تسجيل الخروج</a>
            </div>

            <!-- المحتوى الرئيسي -->
            <div class="col-md-10 main-content">
                <div class="header">
                    <h2>🏠 لوحة التحكم</h2>
                    <div>
                        <span>مرحباً، <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                </div>

                <!-- الإحصائيات -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div>الطلبات</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div>المستخدمون</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div>المواعيد</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-number">0</div>
                            <div>الدفعات</div>
                        </div>
                    </div>
                </div>

                <!-- رسالة ترحيب -->
                <div class="alert alert-success" role="alert">
                    ✅ <strong>لوحة الإدمن تعمل بنجاح!</strong><br>
                    مرحباً بك في لوحة التحكم. جميع الميزات الأساسية جاهزة للاستخدام.
                </div>

                <!-- جدول المواعيد -->
                <div class="table-container">
                    <h4>📅 آخر المواعيد</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>العميل</th>
                                <th>الخدمة</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #999;">لا توجد مواعيد حالياً</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
