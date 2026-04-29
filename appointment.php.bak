<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>الدرة</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        }

        .carousel-caption {
            color: #691E7C;
        }

        .row {
            background-color: #edeef4 !important;
        }

        .btn-primary {
            background-color: #691E7C !important;
            border: none;
        }

        .list-style-arrow {
            list-style-type: none;
            padding: 0;
        }

        ul,
        li {
            margin-top: 0;
            margin-bottom: 10.5px;
        }

        ul.list-style-arrow li {
            padding-right: 1.3em;
            position: relative;
        }

        ul.list-style-arrow li:after {
            content: "\f053";
            font-family: FontAwesome;
            font-size: 12px;
            display: block;
            width: 1.3em;
            position: absolute;
            right: 0;
            top: 5px;
        }

        .story {
            background-image: url(./assets/bg_s_story.jpg);
            background-position: top center;
            background-size: cover;
            min-height: 405px;
        }

        .gols {
            background-image: url(./assets/bg_s_story2.jpg);
            background-position: top center;
            background-size: cover;
            min-height: 543px;
        }

        .overl {
            background-image: url(./assets/overlay_bg.png);
            background-repeat: repeat;
            background-size: 50%;
        }
    </style>
</head>

<body>

    <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav>

    <div class="mt-5 me-3">
        <h5 class="fw-bold">بيانات موعد بدء الخدمة</h5>
        <hr style="background-color: #e7b604;height: 3px;width:150px">
    </div>

    <div class="container mb-5">
        <div class="row px-3">
            <form id="appointmentForm" action="order.php" method="POST">
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
                        <option value="زيارة منزلية 4 ساعات ( 6 دنانير )">زيارة منزلية 4 ساعات ( 6 دنانير )</option>
                        <option value="زيارة منزلية 6 ساعات ( 8 دنانير )">زيارة منزلية 6 ساعات ( 8 دنانير )</option>
                        <option value="زيارة منزلية 8 ساعات ( 10 دنانير )">زيارة منزلية 8 ساعات ( 10 دنانير )</option>
                        <option value="مقيمة مدة 30 يوم بتكلفة 85 دينار">مقيمة مدة 30 يوم بتكلفة 85 دينار</option>
                        <option value="مقيمة مدة 2 شهرين بتكلفة 170 دينار">مقيمة مدة 2 شهرين بتكلفة 170 دينار</option>
                        <option value="مقيمة مدة 3 شهور بتكلفة 255 دينار">مقيمة مدة 3 شهور بتكلفة 255 دينار</option>
                        <option value="مقيمة مدة 6 شهور بتكلفة 510 دينار">مقيمة مدة 6 شهور بتكلفة 510 دينار</option>
                        <option value="مقيمة مدة 1 سنة بتكلفة 800 دينار">مقيمة مدة 1 سنة بتكلفة 800 دينار</option>
                        <option value="مقيمة مدة 2 سنة بتكلفة 1300 دينار">مقيمة مدة 2 سنة بتكلفة 1300 دينار</option>
                        <option value="سائق خاص مدة 30 يوم بتكلفة 90 دينار">سائق خاص مدة 30 يوم بتكلفة 90 دينار</option>
                        <option value="سائق خاص 3 شهور بتكلفة 270 دينار">سائق خاص 3 شهور بتكلفة 270 دينار</option>
                        <option value="سائق خاص مدة 6 شهور 540 دينار">سائق خاص مدة 6 شهور 540 دينار</option>
                        <option value="سائق خاص اسبوعي مدة 30 دينار">سائق خاص اسبوعي مدة 30 دينار</option>
                        <option value="سائق خاص مدة يوم 10 دينار">سائق خاص مدة يوم 10 دينار</option>
                    </select>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <label for="pickupTime" class="fw-bold mb-2"> ساعة استلام العاملة</label>
                    <select name="pickupTime" id="pickupTime" class="form-select w-50" required>
                        <option value="00:00">00:00</option>
                        <option value="00:15">00:15</option>
                        <option value="00:30">00:30</option>
                        <option value="00:45">00:45</option>
                        <option value="01:00">01:00</option>
                        <option value="01:15">01:15</option>
                        <option value="01:30">01:30</option>
                        <option value="01:45">01:45</option>
                        <option value="02:00">02:00</option>
                        <option value="02:15">02:15</option>
                        <option value="02:30">02:30</option>
                        <option value="02:45">02:45</option>
                        <option value="03:00">03:00</option>
                        <option value="03:15">03:15</option>
                        <option value="03:30">03:30</option>
                        <option value="03:45">03:45</option>
                        <option value="04:00">04:00</option>
                        <option value="04:15">04:15</option>
                        <option value="04:30">04:30</option>
                        <option value="04:45">04:45</option>
                        <option value="05:00">05:00</option>
                        <option value="05:15">05:15</option>
                        <option value="05:30">05:30</option>
                        <option value="05:45">05:45</option>
                        <option value="06:00">06:00</option>
                        <option value="06:15">06:15</option>
                        <option value="06:30">06:30</option>
                        <option value="06:45">06:45</option>
                        <option value="07:00">07:00</option>
                        <option value="07:15">07:15</option>
                        <option value="07:30">07:30</option>
                        <option value="07:45">07:45</option>
                        <option value="08:00">08:00</option>
                        <option value="08:15">08:15</option>
                        <option value="08:30">08:30</option>
                        <option value="08:45">08:45</option>
                        <option value="09:00">09:00</option>
                        <option value="09:15">09:15</option>
                        <option value="09:30">09:30</option>
                        <option value="09:45">09:45</option>
                        <option value="10:00">10:00</option>
                        <option value="10:15">10:15</option>
                        <option value="10:30">10:30</option>
                        <option value="10:45">10:45</option>
                        <option value="11:00">11:00</option>
                        <option value="11:15">11:15</option>
                        <option value="11:30">11:30</option>
                        <option value="11:45">11:45</option>
                        <option value="12:00">12:00</option>
                        <option value="12:15">12:15</option>
                        <option value="12:30">12:30</option>
                        <option value="12:45">12:45</option>
                        <option value="13:00">13:00</option>
                        <option value="13:15">13:15</option>
                        <option value="13:30">13:30</option>
                        <option value="13:45">13:45</option>
                        <option value="14:00">14:00</option>
                        <option value="14:15">14:15</option>
                        <option value="14:30">14:30</option>
                        <option value="14:45">14:45</option>
                        <option value="15:00">15:00</option>
                        <option value="15:15">15:15</option>
                        <option value="15:30">15:30</option>
                        <option value="15:45">15:45</option>
                        <option value="16:00">16:00</option>
                        <option value="16:15">16:15</option>
                        <option value="16:30">16:30</option>
                        <option value="16:45">16:45</option>
                        <option value="17:00">17:00</option>
                        <option value="17:15">17:15</option>
                        <option value="17:30">17:30</option>
                        <option value="17:45">17:45</option>
                        <option value="18:00">18:00</option>
                        <option value="18:15">18:15</option>
                        <option value="18:30">18:30</option>
                        <option value="18:45">18:45</option>
                        <option value="19:00">19:00</option>
                        <option value="19:15">19:15</option>
                        <option value="19:30">19:30</option>
                        <option value="19:45">19:45</option>
                        <option value="20:00">20:00</option>
                        <option value="20:15">20:15</option>
                        <option value="20:30">20:30</option>
                        <option value="20:45">20:45</option>
                        <option value="21:00">21:00</option>
                        <option value="21:15">21:15</option>
                        <option value="21:30">21:30</option>
                        <option value="21:45">21:45</option>
                        <option value="22:00">22:00</option>
                        <option value="22:15">22:15</option>
                        <option value="22:30">22:30</option>
                        <option value="22:45">22:45</option>
                        <option value="23:00">23:00</option>
                        <option value="23:15">23:15</option>
                        <option value="23:30">23:30</option>
                        <option value="23:45">23:45</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="gender" class="fw-bold mb-2">الجنس</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="1">أنثى</option>
                        <option value="2">ذكر</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="fw-bold mb-3">يرجى اختيار طريقة الاستلام</label>
                    <div>
                        <input type="radio" class="form-radio" name="method" value="1" required> <span class="fw-bold me-2">مندوب التوصيل</span>
                        <input type="radio" class="form-radio me-4" name="method" value="2"> <span class="fw-bold me-2">مقر الشركة</span>
                    </div>
                </div>


                <div class="text-center">
                    <button type="submit" name="submit" class="w-50 btn btn-primary py-2 mt-4" style="border-radius: 20px;">التالي</button>
                </div>

            </form>
        </div>
    </div>


    <div class="gols pb-5">
        <div class="overl" style="padding: 50px 50px 0 50px;">
            <h1 class="fw-bold text-white"> الأهداف </h1>
            <span style="width: 200px;">
                <hr style="background-color: #e7b604; height: 3px;">
            </span>
            <ul class="list-style-arrow last-rtl text-white">
                <li class="text-white">توفير عمالة منزلية مدربة.</li>
                <li class="text-white">كسر الممارسات الاحتكارية والمبالغة في رسوم الاستقدام.</li>
                <li class="text-white">تصويب مسار سوق استقدام وتشغيل العمالة المنزلية وإعادة الثقة إليه.</li>
                <li class="text-white">تذليل عقبات وإجراءات الاستقدام وتحقيق سرعة العمل والإنجاز.</li>
                <li class="text-white">خلق علاقات إنسانية سليمة بين رب العمل والعامل وضمان رضا كافة الأطراف.</li>
                <li class="text-white">توفير قاعدة بيانات إلكترونية تشمل الأيدي العاملة المتاحة والتي تم استقدامها ومصادر تصدير العمالة.</li>
                <li class="text-white">تحسين صورة الكويت في المنظمات الدولية ذات العلاقة بهذا المجال.</li>
                <li class="text-white">بناء علاقات متينة مع الدول المصدرة للعمالة</li>
            </ul>

            <h1 class="fw-bold text-white mt-5"> قيمنا </h1>
            <span style="width: 200px;">
                <hr style="background-color: #e7b604; height: 3px;">
            </span>
            <ul class="list-style-arrow last-rtl">
                <li class="text-white">التعامل بصدق وعدالة وشفافية مع عملائنا وعمالتنا.</li>
                <li class="text-white">عدم استغلال حاجة رب العمل والسوق لتحقيق أرباح غير عادلة.</li>
                <li class="text-white">الحفاظ على هويتنا وعاداتنا الأصيلة.</li>
                <li class="text-white">الاستفادة من أحدث التكنولوجيات في إدارة العمل.</li>
            </ul>
        </div>

    </div>

    <script>
        // التحقق من البيانات قبل الإرسال
        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
            const nationality = document.getElementById('nationality').value;
            const service = document.getElementById('service').value;
            const startDate = document.getElementById('startDate').value;
            const duration = document.getElementById('duration').value;
            const pickupTime = document.getElementById('pickupTime').value;
            const gender = document.getElementById('gender').value;
            const method = document.querySelector('input[name="method"]:checked');

            if (!nationality || nationality === '') {
                e.preventDefault();
                alert('يرجى اختيار الجنسية');
                return false;
            }

            if (!service || service === '') {
                e.preventDefault();
                alert('يرجى اختيار باقة الخدمة');
                return false;
            }

            if (!startDate) {
                e.preventDefault();
                alert('يرجى اختيار تاريخ بدء الخدمة');
                return false;
            }

            if (!duration || duration === '') {
                e.preventDefault();
                alert('يرجى اختيار مدة الخدمة');
                return false;
            }

            if (!pickupTime) {
                e.preventDefault();
                alert('يرجى اختيار ساعة الاستلام');
                return false;
            }

            if (!gender) {
                e.preventDefault();
                alert('يرجى اختيار الجنس');
                return false;
            }

            if (!method) {
                e.preventDefault();
                alert('يرجى اختيار طريقة الاستلام');
                return false;
            }

            // إذا كانت جميع البيانات صحيحة، سيتم إرسال النموذج
            console.log('Form data is valid, submitting...');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
