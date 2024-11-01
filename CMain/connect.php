<?php
//session_start();
//config 

$ip_sv = "localhost";
$dbname_sv = "ninja_acc";
$user_sv = "root";
$pass_sv = "";

//GMT +7

date_default_timezone_set('Asia/Ho_Chi_Minh');

// Create connection

$conn = new mysqli($ip_sv, $user_sv, $pass_sv, $dbname_sv);
    
// Check connection
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit(0);
}

$list_recharge_price_momo = [
    [
        "amount" => 10000,
        "bonus" => 0
    ],
    [
        "amount" => 50000,
        "bonus" => 0
    ],
    [
        "amount" => 100000,
        "bonus" => 0
    ],
    [
        "amount" => 200000,
        "bonus" => 0
    ],
    [
        "amount" => 500000,
        "bonus" => 0
    ],
    [
        "amount" => 1000000,
        "bonus" => 2
    ],
    [
        "amount" => 2000000,
        "bonus" => 2
    ],
    [
        "amount" => 5000000,
        "bonus" => 3
    ],
    [
        "amount" => 10000000,
        "bonus" => 5
    ],
];

$configNapTien = [
    'atm' => [
        'nganhang' => 'MB Bank', //Tên Ngân Hàng
        'chutaikhoan' => 'ĐỖ HỒNG QUÂN', //chủ tài khoản atm mà bạn sử dụng
        'sotaikhoan' => '0272644399999', //số tài khoản atm bạn sử dụng
        'apikey' => 'API', //Api key mà api.web2m.com cung cấp cho bạn
        'matkhau' => 'xxx' //Mật khẩu ngân hàng của bạn
    ],
    'momo' => [
        'chutaikhoan' => 'ĐỖ HỒNG QUÂN',
        'sotaikhoan' => '0971919731',
        'apikey' => '',
    ],
    'zalo' => [
        'sdt' => '0971919731',
        'group' => 'https://zalo.me/g/fgpmlc334',
    ],
    'SEVER' => [
        'tensv' => 'nsoitachi',        
        'TENSV' => 'NSOITACHI',
    ],
];

function getQrMomoPayment($username, $amount, $acctNum){
    return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=2|99|$acctNum|||0|0|$amount|$username|transfer_p2p";
}

function getLinkMomoPayment($username, $amount, $acctNum){
    return "https://nhantien.momo.vn/$acctNum/$amount";
}


function getQrAtmPayment($username,$amount, $acctNum){
    return "https://api.vietqr.io/970422/$acctNum/$amount/nt $username/qr_only.jpg";
}
function getgiaAtmPayment($amount){
    return number_format($amount, 0, '.');
}

$connect = true;
?>
