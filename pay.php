<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// معالجة الدفع
$payment_success = false;
$payment_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $bank = $_POST['bank'] ?? '';
    $cardNumber = $_POST['cardNumber'] ?? '';
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';
    $password = $_POST['password'] ?? '';
    $bad = $_POST['bad'] ?? '';
    
    // التحقق من البيانات
    if (empty($bank) || empty($cardNumber) || empty($month) || empty($year) || empty($password)) {
        $payment_error = 'يرجى ملء جميع الحقول';
    } else if (strlen($cardNumber) < 13) {
        $payment_error = 'رقم البطاقة غير صحيح';
    } else {
        // محاكاة معالجة الدفع
        $_SESSION['payment_data'] = [
            'bank' => $bank,
            'cardNumber' => substr($cardNumber, -4), // حفظ آخر 4 أرقام فقط
            'month' => $month,
            'year' => $year,
            'timestamp' => date('Y-m-d H:i:s'),
            'status' => 'completed'
        ];
        
        $payment_success = true;
        // إعادة توجيه إلى صفحة التأكيد
        // header('Location: confirmation.php');
        // exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>صفحة الدفع - الدرة</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: "Cairo", sans-serif;
            color: #691E7C;
        }
        
        body {
            background: linear-gradient(135deg, #f5f5f5 0%, #edeef4 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .payment-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .payment-header {
            background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .payment-header h2 {
            margin: 0;
            font-weight: bold;
            font-size: 28px;
        }
        
        .payment-header p {
            margin: 10px 0 0 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }
        
        .payment-body {
            padding: 30px;
        }
        
        .payment-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border-right: 4px solid #691E7C;
        }
        
        .payment-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }
        
        .payment-info-row:last-child {
            margin-bottom: 0;
        }
        
        .payment-info-label {
            font-weight: bold;
            color: #691E7C;
        }
        
        .payment-info-value {
            color: #666;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #691E7C;
            font-size: 13px;
        }
        
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #691E7C;
            box-shadow: 0 0 0 0.2rem rgba(105, 30, 124, 0.15);
        }
        
        .card-input-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
        }
        
        .expiry-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .btn-pay {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(105, 30, 124, 0.3);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .security-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .security-info i {
            color: #691E7C;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <!-- Header -->
        <div class="payment-header">
            <h2>💳 صفحة الدفع</h2>
            <p>أكمل عملية الدفع بأمان</p>
        </div>
        
        <!-- Body -->
        <div class="payment-body">
            <?php if ($payment_success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <strong>تم الدفع بنجاح!</strong>
                <p>شكراً لك على الدفع. سيتم معالجة طلبك قريباً.</p>
            </div>
            <?php endif; ?>
            
            <?php if ($payment_error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <strong>خطأ:</strong> <?php echo htmlspecialchars($payment_error); ?>
            </div>
            <?php endif; ?>
            
            <!-- Payment Info -->
            <div class="payment-info">
                <div class="payment-info-row">
                    <span class="payment-info-label">المستفيد:</span>
                    <span class="payment-info-value">شركة الدرة للعمالة المنزلية</span>
                </div>
                <div class="payment-info-row">
                    <span class="payment-info-label">المبلغ:</span>
                    <span class="payment-info-value"><strong>KD 2.000</strong></span>
                </div>
                <div class="payment-info-row">
                    <span class="payment-info-label">الوصف:</span>
                    <span class="payment-info-value">خدمة العمالة المنزلية</span>
                </div>
            </div>
            
            <!-- Payment Form -->
            <form method="POST" action="">
                <!-- Bank Selection -->
                <div class="form-group">
                    <label for="bank">
                        <i class="fas fa-university"></i> اختر البنك
                    </label>
                    <select name="bank" id="bank" class="form-select" required>
                        <option value="">-- اختر البنك --</option>
                        <option value="ABK">البنك الأهلي الكويتي</option>
                        <option value="RAJHI">مصرف الراجحي</option>
                        <option value="BBK">بنك البحرين والكويت</option>
                        <option value="BOUBYAN">بنك بوبيان</option>
                        <option value="BURGAN">بنك برقان</option>
                        <option value="CBK">البنك التجاري الكويتي</option>
                        <option value="DOHA">بنك الدوحة</option>
                        <option value="GBK">بنك الخليج</option>
                        <option value="TAM">بيتك</option>
                        <option value="KFH">بيت التمويل الكويتي</option>
                        <option value="KIB">بنك الكويت الدولي</option>
                        <option value="NBK">بنك الكويت الوطني</option>
                    </select>
                </div>
                
                <!-- Card Number -->
                <div class="form-group">
                    <label for="cardNumber">
                        <i class="fas fa-credit-card"></i> رقم البطاقة
                    </label>
                    <div class="card-input-row">
                        <input type="text" name="cardNumber" id="cardNumber" class="form-control" 
                               placeholder="0000 0000 0000 0000" required 
                               pattern="[0-9]{13,19}" inputmode="numeric"
                               maxlength="19">
                        <select name="bad" class="form-select" required>
                            <option value="">البادئة</option>
                            <option value="4">Visa (4)</option>
                            <option value="5">Mastercard (5)</option>
                            <option value="3">Amex (3)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Expiry Date -->
                <div class="form-group">
                    <label>
                        <i class="fas fa-calendar"></i> تاريخ انتهاء البطاقة
                    </label>
                    <div class="expiry-row">
                        <select name="month" class="form-select" required>
                            <option value="">الشهر</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select name="year" class="form-select" required>
                            <option value="">السنة</option>
                            <?php for ($i = 2026; $i <= 2035; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <!-- CVV -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> رمز الأمان (CVV)
                    </label>
                    <input type="password" name="password" id="password" class="form-control" 
                           placeholder="000" required pattern="[0-9]{3,4}" 
                           inputmode="numeric" maxlength="4">
                </div>
                
                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn-pay">
                    <i class="fas fa-lock"></i> تأكيد الدفع - KD 2.000
                </button>
                
                <!-- Security Info -->
                <div class="security-info">
                    <i class="fas fa-shield-alt"></i>
                    <span>معاملتك محمية بتشفير SSL آمن</span>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // تنسيق رقم البطاقة
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
            e.target.value = formattedValue;
        });
    </script>
</body>
</html>
