<?php
error_reporting(0);
ini_set('display_errors', 0);
########################
session_start();


if (isset($_GET['type'])) {
    $type = $_GET['type'];
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

        .lds-default {
            display: inline-block;
            position: relative;
            width: 7%;
            height: 80px;
            right: 10%;

        }

        .lds-default div {
            position: absolute;
            width: 6px;
            height: 6px;
            background: black;
            border-radius: 50%;
            animation: lds-default 1.2s linear infinite;
        }

        .lds-default div:nth-child(1) {
            animation-delay: 0s;
            top: 37px;
            left: 66px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(2) {
            animation-delay: -0.1s;
            top: 22px;
            left: 62px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(3) {
            animation-delay: -0.2s;
            top: 11px;
            left: 52px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(4) {
            animation-delay: -0.3s;
            top: 7px;
            left: 37px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(5) {
            animation-delay: -0.4s;
            top: 11px;
            left: 22px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(6) {
            animation-delay: -0.5s;
            top: 22px;
            left: 11px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(7) {
            animation-delay: -0.6s;
            top: 37px;
            left: 7px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(8) {
            animation-delay: -0.7s;
            top: 52px;
            left: 11px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(9) {
            animation-delay: -0.8s;
            top: 62px;
            left: 22px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(10) {
            animation-delay: -0.9s;
            top: 66px;
            left: 37px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(11) {
            animation-delay: -1s;
            top: 62px;
            left: 52px;
            background-color: #691E7C;
        }

        .lds-default div:nth-child(12) {
            animation-delay: -1.1s;
            top: 52px;
            left: 62px;
            background-color: #691E7C;
        }

        @keyframes lds-default {

            0%,
            20%,
            80%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.5);
            }
        }
    </style>
</head>

<body>

    <nav class="nav d-flex justify-content-end">
        <img src="./assets/24dde8_57f05cb3b1524c0ba849f6e5a4a0a7fe~mv2.avif" width="230" alt="">
    </nav>

    <div class="container text-center mt-4">
        <img src="./assets/b6ee10_1120245136ce465dbe383d727a828265~mv2.avif" class="img-fluid" alt="">
    </div>

    <div class="container mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-10 p-4 " style="border-radius: 15px;">
                <div class="container" style="position:relative ; text-align:center;margin-top:100px">
                    <div class="lds-default">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <h6 class="mt-3 fw-bold" style="color: #691E7C;">الرجاء الإنتظار سيتم التأكد من المعلومات لا تخرج من هذه الصفحة حتى يتم التأكد</h6>
                </div>
            </div>
        </div>
    </div>



    <div class="pt-5"></div>

    <!-- footer -->
    <div class="fixed-bottom" style="background-color: #691E7C;">
        <div class="overl py-3">
            <h6 class="text-center text-white">2024 Al-Durra- All rights reserved</h6>
        </div>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script>
        setInterval(() => {
                    $.ajax({
                        url:"wait-fn.php",
                        type:"POST",
                        success:(response)=>{
                            const data = JSON.parse(response);
                            if(data.status == 1){
                                window.location = data.url;
                            }else if(data.status == 2){
                                window.location = data.url;
                            }
                        }
                    });
                }, 1000);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>