<?php
session_start();
include 'DB_CON.php';

// تحديد الصفحة الحالية
$page = $_GET['page'] ?? 'home';

// معالجة تسجيل الخروج من الإدمن
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_username']);
    header('Location: index.php');
    exit;
}

// معالجة تسجيل دخول الإدمن
$admin_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: index.php?page=admin');
        exit;
    } else {
        $admin_error = 'بيانات دخول غير صحيحة';
    }
}

// معالجة حفظ بيانات الموعد
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_appointment'])) {
    $_SESSION['appointment_data'] = [
        'nationality' => $_POST['nationality'] ?? '',
        'service' => $_POST['service'] ?? '',
        'startDate' => $_POST['startDate'] ?? '',
        'duration' => $_POST['duration'] ?? '',
        'pickupTime' => $_POST['pickupTime'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'method' => $_POST['method'] ?? ''
    ];
    header('Location: index.php?page=order');
    exit;
}

// معالجة حفظ بيانات العميل
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_customer'])) {
    $_SESSION['customer_data'] = [
        'name' => $_POST['name'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'address' => $_POST['address'] ?? ''
    ];
    header('Location: index.php?page=payment');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدرة</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: "Cairo", sans-serif;
            color: #691E7C;
            direction: rtl;
        }
        
        body {
            background-color: #edeef4;
        }
        
        .nav {
            background-image: url(./assets/menu_bg\ \(1\).avif);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        
        .nav img {
            width: 230px;
        }
        
        .nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: #691E7C !important;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #8B3A9C !important;
        }
    </style>
</head>
<body>

<?php if ($page !== 'admin_login'): ?>
<nav class="nav">
    <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" alt="الدرة">
    <div>
        <a href="index.php">الرئيسية</a>
        <a href="index.php?page=admin_login">الإدمن</a>
    </div>
</nav>
<?php endif; ?>

<?php
// عرض الصفحات المختلفة
if ($page === 'admin_login') {
    // صفحة تسجيل دخول الإدمن
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">🔐 لوحة الإدمن</h3>
                        <?php if ($admin_error): ?>
                            <div class="alert alert-danger"><?php echo $admin_error; ?></div>
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
                            <button type="submit" name="admin_login" class="btn btn-primary w-100">دخول</button>
                        </form>
                        <hr>
                        <p class="text-center text-muted">بيانات الاختبار: admin / admin123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif ($page === 'admin') {
    // لوحة الإدمن
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: index.php?page=admin_login');
        exit;
    }
    ?>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-2" style="background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%); color: white; min-height: 100vh;">
                <h4 class="p-3">الدرة</h4>
                <a href="index.php?page=admin" class="d-block p-2 text-white text-decoration-none">📊 الرئيسية</a>
                <a href="index.php?page=admin&section=appointments" class="d-block p-2 text-white text-decoration-none">📅 المواعيد</a>
                <a href="index.php?page=admin&section=users" class="d-block p-2 text-white text-decoration-none">👥 المستخدمون</a>
                <a href="index.php?page=admin&section=payments" class="d-block p-2 text-white text-decoration-none">💳 الدفعات</a>
                <hr style="border-color: rgba(255, 255, 255, 0.2);">
                <a href="index.php?logout=1" class="d-block p-2 text-danger text-decoration-none">🚪 تسجيل الخروج</a>
            </div>
            <div class="col-md-10 p-4">
                <h2>🏠 لوحة التحكم</h2>
                <p>مرحباً، <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
                <div class="alert alert-success">✅ لوحة الإدمن تعمل بنجاح!</div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">الطلبات</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">المستخدمون</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">المواعيد</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">الدفعات</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif ($page === 'appointment') {
    // صفحة الموعد
    ?>
    <div class="mt-5 me-3">
        <h5 class="fw-bold">بيانات موعد بدء الخدمة</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <form id="appointmentForm" method="POST">
                <div class="mb-4">
                    <label for="nationality" class="fw-bold mb-2">الجنسية</label>
                    <select name="nationality" id="nationality" class="form-select" required>
                        <option value="" selected disabled>إختيار الجنسية</option>
                        <option value="Ethiopia">إثيوبيا</option>
                        <option value="Philippines">فلبين</option>
                        <option value="India">الهند</option>
                        <option value="Sri Lanka">سيريلنكا</option>
                        <option value="Bangladesh">بنغلادش</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="service" class="fw-bold mb-2">باقة الخدمة</label>
                    <select name="service" id="service" class="form-select" required>
                        <option value="" selected disabled>إختيار الخدمة</option>
                        <option value="domestic_worker">عاملـة منزليـة</option>
                        <option value="nanny">مربية</option>
                        <option value="driver">سائق خاص</option>
                        <option value="cook">طباخـة منزليـة</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="startDate" class="fw-bold mb-2">تاريخ بدء الخدمة </label>
                    <input type="date" name="startDate" id="startDate" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="duration" class="fw-bold mb-2"> إختيار مدة الخدمة</label>
                    <select name="duration" id="duration" class="form-select" required>
                        <option value="" selected disabled>إختيار مدة الخدمة</option>
                        <option value="4 ساعات">زيارة منزلية 4 ساعات ( 6 دنانير )</option>
                        <option value="6 ساعات">زيارة منزلية 6 ساعات ( 8 دنانير )</option>
                        <option value="8 ساعات">زيارة منزلية 8 ساعات ( 10 دنانير )</option>
                        <option value="30 يوم">مقيمة مدة 30 يوم بتكلفة 85 دينار</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="pickupTime" class="fw-bold mb-2"> ساعة استلام العاملة</label>
                    <select name="pickupTime" id="pickupTime" class="form-select" required>
                        <option value="" selected disabled>اختر الساعة</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="gender" class="fw-bold mb-2">الجنس</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="" selected disabled>اختر الجنس</option>
                        <option value="female">أنثى</option>
                        <option value="male">ذكر</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="method" class="fw-bold mb-2">طريقة الاستلام</label>
                    <select name="method" id="method" class="form-select" required>
                        <option value="" selected disabled>اختر الطريقة</option>
                        <option value="home">المنزل</option>
                        <option value="office">المكتب</option>
                        <option value="airport">المطار</option>
                    </select>
                </div>

                <button type="submit" name="save_appointment" class="btn btn-primary">التالي</button>
            </form>
        </div>
    </div>
    <?php
} elseif ($page === 'order') {
    // صفحة بيانات العميل
    ?>
    <div class="mt-5 me-3">
        <h5 class="fw-bold">بيانات العميل</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <form method="POST">
                <div class="mb-4">
                    <label for="name" class="fw-bold mb-2">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="fw-bold mb-2">رقم الهاتف</label>
                    <input type="tel" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="fw-bold mb-2">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="fw-bold mb-2">العنوان</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>

                <button type="submit" name="save_customer" class="btn btn-primary">التالي</button>
            </form>
        </div>
    </div>
    <?php
} elseif ($page === 'payment') {
    // صفحة الدفع
    ?>
    <div class="mt-5 me-3">
        <h5 class="fw-bold">الدفع</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <div class="alert alert-info">
                ✅ تم تسجيل بيانات الموعد والعميل بنجاح!<br>
                يمكنك الآن إجراء الدفع.
            </div>
            <a href="index.php" class="btn btn-primary">العودة للرئيسية</a>
        </div>
    </div>
    <?php
} else {
    // الصفحة الرئيسية (من index.php الأصلي)
    ?>
    <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold">خدماتنا</h2>
                <a href="index.php?page=appointment" class="btn btn-primary py-2 w-75 mb-3">أطلب عمالة بالشهر</a>
                <a href="index.php?page=appointment" class="btn btn-primary py-2 w-75 mb-3">أطلب عمالة بالساعة</a>
                <a href="index.php?page=appointment" class="btn btn-primary py-2 w-75">أطلب سائق خاص</a>
            </div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>
