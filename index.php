<?php
session_start();
include 'DB_CON.php';

// معالجة تسجيل الخروج من الإدمن
if (isset($_POST['logout'])) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_username']);
}

// معالجة تسجيل دخول الإدمن
$admin_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
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
}

// معالجة حفظ بيانات العميل
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_customer'])) {
    $_SESSION['customer_data'] = [
        'name' => $_POST['name'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'address' => $_POST['address'] ?? ''
    ];
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
            cursor: pointer;
        }
        
        .nav a:hover {
            text-decoration: underline;
        }
        
        .btn-primary {
            background-color: #691E7C !important;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #8B3A9C !important;
        }
        
        .page {
            display: none;
        }
        
        .page.active {
            display: block;
        }
    </style>
</head>
<body>

<div id="nav-container">
    <nav class="nav">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" alt="الدرة">
        <div>
            <a onclick="navigate('home')">الرئيسية</a>
            <a onclick="navigate('admin_login')">الإدمن</a>
        </div>
    </nav>
</div>

<!-- الصفحة الرئيسية -->
<div id="home" class="page active">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold">خدماتنا</h2>
                <button onclick="navigate('appointment')" class="btn btn-primary py-2 w-75 mb-3">أطلب عمالة بالشهر</button>
                <button onclick="navigate('appointment')" class="btn btn-primary py-2 w-75 mb-3">أطلب عمالة بالساعة</button>
                <button onclick="navigate('appointment')" class="btn btn-primary py-2 w-75">أطلب سائق خاص</button>
            </div>
        </div>
    </div>
</div>

<!-- صفحة الموعد -->
<div id="appointment" class="page">
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

                <button type="submit" name="save_appointment" class="btn btn-primary" onclick="navigate('order')">التالي</button>
            </form>
        </div>
    </div>
</div>

<!-- صفحة بيانات العميل -->
<div id="order" class="page">
    <div class="mt-5 me-3">
        <h5 class="fw-bold">بيانات العميل</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <form id="customerForm" method="POST">
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

                <button type="submit" name="save_customer" class="btn btn-primary" onclick="navigate('payment')">التالي</button>
            </form>
        </div>
    </div>
</div>

<!-- صفحة الدفع -->
<div id="payment" class="page">
    <div class="mt-5 me-3">
        <h5 class="fw-bold">الدفع</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <div class="alert alert-success">
                ✅ تم تسجيل بيانات الموعد والعميل بنجاح!<br>
                يمكنك الآن إجراء الدفع.
            </div>
            <button onclick="navigate('home')" class="btn btn-primary">العودة للرئيسية</button>
        </div>
    </div>
</div>

<!-- صفحة تسجيل دخول الإدمن -->
<div id="admin_login" class="page">
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
</div>

<!-- لوحة الإدمن -->
<?php if (isset($_SESSION['admin_logged_in'])): ?>
<div id="admin" class="page">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-2" style="background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%); color: white; min-height: 100vh;">
                <h4 class="p-3">الدرة</h4>
                <a onclick="navigate('admin')" class="d-block p-2 text-white text-decoration-none" style="cursor: pointer;">📊 الرئيسية</a>
                <a onclick="navigate('admin_appointments')" class="d-block p-2 text-white text-decoration-none" style="cursor: pointer;">📅 المواعيد</a>
                <a onclick="navigate('admin_users')" class="d-block p-2 text-white text-decoration-none" style="cursor: pointer;">👥 المستخدمون</a>
                <a onclick="navigate('admin_payments')" class="d-block p-2 text-white text-decoration-none" style="cursor: pointer;">💳 الدفعات</a>
                <hr style="border-color: rgba(255, 255, 255, 0.2);">
                <form method="POST" style="display: inline;">
                    <button type="submit" name="logout" class="btn btn-danger w-100">🚪 تسجيل الخروج</button>
                </form>
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
</div>
<?php endif; ?>

<script>
function navigate(page) {
    // إخفاء جميع الصفحات
    const pages = document.querySelectorAll('.page');
    pages.forEach(p => p.classList.remove('active'));
    
    // إظهار الصفحة المطلوبة
    const targetPage = document.getElementById(page);
    if (targetPage) {
        targetPage.classList.add('active');
    }
    
    // تحديث الـ URL
    window.location.hash = page;
    
    // إخفاء الـ nav في صفحة تسجيل دخول الإدمن
    const navContainer = document.getElementById('nav-container');
    if (page === 'admin_login') {
        navContainer.style.display = 'none';
    } else {
        navContainer.style.display = 'block';
    }
}

// التعامل مع الـ hash عند تحميل الصفحة
window.addEventListener('hashchange', function() {
    const page = window.location.hash.slice(1) || 'home';
    navigate(page);
});

// تحميل الصفحة الأولى عند فتح الموقع
window.addEventListener('load', function() {
    const page = window.location.hash.slice(1) || 'home';
    navigate(page);
});
</script>

</body>
</html>
