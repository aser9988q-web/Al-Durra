<?php
// لوحة إدمن بسيطة جداً بدون Session

// التحقق من بيانات الدخول
$logged_in = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // بيانات الإدمن الافتراضية
    if ($username === 'admin' && $password === 'admin123') {
        $logged_in = true;
    } else {
        $error = 'بيانات دخول غير صحيحة';
    }
}

// إذا لم يكن مسجل دخول، عرض صفحة تسجيل الدخول
if (!$logged_in) {
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
            <?php if ($error): ?>
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

// إذا كان مسجل دخول، عرض لوحة الإدمن
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- الشريط الجانبي -->
            <div class="col-md-3 sidebar">
                <h2>🏢 الدرة</h2>
                <a href="#" class="active"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="#"><i class="fas fa-shopping-cart"></i> الطلبات</a>
                <a href="#"><i class="fas fa-users"></i> المستخدمون</a>
                <a href="#"><i class="fas fa-calendar"></i> المواعيد</a>
                <a href="#"><i class="fas fa-credit-card"></i> الدفعات</a>
                <a href="#"><i class="fas fa-cog"></i> الإعدادات</a>
                <hr>
                <a href="admin-simple.php?logout=true"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
            </div>
            
            <!-- المحتوى الرئيسي -->
            <div class="col-md-9 main-content">
                <div class="header">
                    <div>
                        <h1>مرحباً بك في لوحة الإدمن</h1>
                        <p style="color: #666; margin: 0;">أهلاً بك في لوحة التحكم</p>
                    </div>
                    <div>
                        <span style="color: #666;">آخر تحديث: <?php echo date('Y-m-d H:i:s'); ?></span>
                    </div>
                </div>
                
                <!-- الإحصائيات -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                            <h3>الطلبات</h3>
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <h3>المستخدمون</h3>
                            <div class="number">0</div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-calendar"></i></div>
                            <h3>المواعيد</h3>
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-credit-card"></i></div>
                            <h3>إجمالي الدفعات</h3>
                            <div class="number">0.00 د.ك</div>
                        </div>
                    </div>
                </div>
                
                <!-- رسالة ترحيب -->
                <div class="stat-card" style="margin-top: 30px;">
                    <h3>✅ لوحة التحكم تعمل بنجاح!</h3>
                    <p style="color: #666; margin: 0;">استخدم القائمة الجانبية للتنقل بين الأقسام المختلفة.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
