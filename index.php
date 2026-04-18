<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>الدرة</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/24dde8_0db91c8fda04473fb47226437e5c4f92~mv2.avif" class="d-block w-100" alt="...">
                <div class="carousel-caption pb-0 text-center d-md-block">
                    <span style="font-size: 10px;">شركة الدرة</span><br>
                    <span style="font-size: 10px;">الدرة للعمالة</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/24dde8_d002ef03446a473599920c653bf27a83~mv2.avif" class="d-block w-100" alt="...">
                <div class="carousel-caption pb-0 text-center d-md-block">
                    <span style="font-size: 10px;">شركة الدرة</span><br>
                    <span style="font-size: 10px;">الدرة للعمالة</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/b6ee10_2f760358fb0e49d2ae6db818d9fd8a1a~mv2.avif" class="d-block w-100" alt="...">
                <div class="carousel-caption pb-0 text-center d-md-block">
                    <span style="font-size: 10px;">شركة الدرة</span><br>
                    <span style="font-size: 10px;">الدرة للعمالة</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/b6ee10_1120245136ce465dbe383d727a828265~mv2.avif" class="d-block w-100" alt="...">
                <div class="carousel-caption pb-0 text-center d-md-block">
                    <span style="font-size: 10px;">شركة الدرة</span><br>
                    <span style="font-size: 10px;">الدرة للعمالة</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/b6ee10_a30f3b91660e41b4b56e7b52643f4858~mv2.avif" class="d-block w-100" alt="...">
                <div class="carousel-caption pb-0 text-center d-md-block">
                    <span style="font-size: 10px;">شركة الدرة</span><br>
                    <span style="font-size: 10px;">الدرة للعمالة</span>
                </div>
            </div>

        </div>
    </div>

    <div class="container" style="margin-top: 35px;">
        <div class="row d-flex justify-content-center">
            <div class="col-10 text-center">
                <h5 class="mb-4">يرجى تحديد الخدمة التي تناسبك</h5>
                <a href="./copy.php?type=1" class="btn btn-primary py-2 w-75" style="border-radius: 20px;"><i class="bi bi-arrow-right text-light ms-2"></i> أطلب عمالة بالشهر </a>
                <a href="./copy.php?type=2" class="btn btn-primary py-2 w-75 my-3" style="border-radius: 20px;"><i class="bi bi-arrow-right text-light ms-2"></i> أطلب عمالة بالساعة </a>
                <a href="./copy.php?type=3" class="btn btn-primary py-2 w-75" style="border-radius: 20px;"><i class="bi bi-arrow-right text-light ms-2"></i> أطلب سائق خاص </a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 100px;">
        <div class="row px-4">
            <h1 class="fw-bold"> نبذه عن الشركه </h1>
            <span style="width: 300px;"><hr style="background-color: #e7b604;height: 3px;"></span>
            <p>شركة الدرة لاستقدام وتشغيل العمالة المنزلية هي الأولى في الكويت التي تتشكل من جهات وطنية تهتم بالصالح العام وتحقق نقلة نوعية في هذا النوع من الأعمال. </p>
            <ul class="list-style-arrow" id="menu">
                <li>نحمل رؤية ورسالة وطنية وإنسانية في إدارة سوق العمل.</li>
                <li>نتولى كل الإجراءات بدءا من دولة المصدر إلى الفحوصات والإقامة بدولة الكويت وذلك بأسعار تنافسية ورمزية وبأعلى قدر من الكفاءة وسرعة الإنجاز.</li>
                <li>نعمل على تأهيل العمالة المرشحة للعمل بالبلاد وإكسابها قدراً من المعلومات عن ثقافة وتقاليد وعادات مجتمعنا والأسر الكويتية من خلال دورات تأهيلية في بلدها.</li>
                <li>نضمن سلامة العمالة المستقدمة وخلوها من الأمراض قبل قدومها للبلاد وذلك بفحصها في المراكز المعتمدة من وزارة الصحة في الدولة المصدرة.</li>
                <li>لدينا قاعدة بيانات وأرشيف يدار بأحدث وسائل التكنولوجيا ويضم معلومات وبيانات العمالة وطرق تحديد هويتها. نتفرد بخدمات المتابعة إلكترونياً حيث يمكنك متابعة خطوات الاستقدام منذ تقديم الطلب وحتى حضور العمالة لحظة بلحظة.</li>
                <li>لدينا فروع في كل محافظات الكويت بالجمعيات التعاونية، ولدينا مكاتب في عدد من دول العالم. "سوق الدرة" يقدم لك باقة متنوعة من اليونيفورم وكافة احتياجات العمالة.</li>
                <li>من خلال موقعنا هذا يمكن تقديم طلب استقدام العمالة وإنهاء كافة الإجراءات إلكترونياً (أون لاين) .. كما نتيح للكفيل استخراج الفيزا "أون لاين".</li>
            </ul>
        </div>
    </div>

    <div class="container story py-5">
        <div class="py-5" style="background-color:rgba(255, 255, 255, 0.8);padding: 0 100px;">
            <h1 class="fw-bold"> الرسالة </h1>
            <span style="width: 200px;"><hr style="background-color: #691E7C; height: 3px;"></span>
            <p> تقديم تجربة فريدة لعملائنا تقوم على التميز في توفير عمالة ذات كفاءة عالية تتوافق مع احتياجات صاحب العمل، وترسيخ ثقافة احترام حقوق العامل وصاحب العمل وفقاً للمصلحة المشتركة ومبادئ حقوق الإنسان، مع المساهمة في تنظيم النشاط والارتقاء به وتقديم
                أفضل صورة عن الكويت في الخارج </p>

            <h1 class="fw-bold"> الرؤية </h1>
            <span style="width: 200px;"><hr style="background-color: #691E7C; height: 3px;"></span>
            <p> أن تكون شركة الدرة لاستقدام وتشغيل العمالة المنزلية هي الشركة الرائدة في دولة الكويت في مجال عملها، وأن نكون خياركم الأول في رحلة البحث عن العمالة المناسبة والماهرة </p>

        </div>
    </div>

    <div class="gols pb-5">
        <div class="overl" style="padding: 50px 50px 0 50px;">
            <h1 class="fw-bold text-white"> الأهداف </h1>
            <span style="width: 200px;"><hr style="background-color: #e7b604; height: 3px;"></span>
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

            <h1 class="fw-bold text-white mt-5">           قيمنا  </h1>
            <span style="width: 200px;"><hr style="background-color: #e7b604; height: 3px;"></span>
            <ul class="list-style-arrow last-rtl">       
                <li class="text-white">التعامل بصدق وعدالة وشفافية مع عملائنا وعمالتنا.</li>
                <li class="text-white">عدم استغلال حاجة رب العمل والسوق لتحقيق أرباح غير عادلة.</li>
                <li class="text-white">الحفاظ على هويتنا وعاداتنا الأصيلة.</li>
                <li class="text-white">الاستفادة من أحدث التكنولوجيات في إدارة العمل.</li>
            </ul>
        </div>

    </div>

    <!-- footer -->
    <div style="background-color: #691E7C;">
        <div class="overl py-3">
            <h6 class="text-center text-white">2024 Al-Durra-  All rights reserved</h6>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>