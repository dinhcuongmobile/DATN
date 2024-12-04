<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "ELVAQEWH"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "UMNOHDQWWDIRGSNATSWASPXTXOFSMHZR"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://127.0.0.1:8000/vnpay_php/vnpay_return.blade.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("Y-m-d H:i:s");
$expire = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($startTime)));
