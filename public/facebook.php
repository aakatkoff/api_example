<?php

require_once '../vendor/autoload.php';

if (isset($_SERVER['HTTP_X_REAL_IP'])) {
    $called_ip = $_SERVER['HTTP_X_REAL_IP'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $called_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $called_ip = $_SERVER['REMOTE_ADDR'];
}


$phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
$phoneNumber = $phoneNumberUtil->parse($_POST['phone'], 'ID');
$countryKey = $phoneNumberUtil->getRegionCodeForCountryCode($phoneNumber->getCountryCode());

$infocdnData = [
    'orders' => [
        [
            'country'           =>  $countryKey, // страна доставки
            'fio'               =>  $_POST['name'], // Имя
            'phone'             =>  $_POST['phone'], // Телефон
            'user_ip'           =>  $called_ip, // ip сервера в данном случае
            'user_agent'        =>  'FacebookWebhook', // UserAgent пользователя
            'order_time'        =>  time(), // timestamp времени заказа
        ]
    ],
    'system'    =>  [
        'network'   => 'ad1', // название сети
        'thread'    => $_POST['thread'], // id потока из ad1.ru, например bakm
        'subid'     => '', // 5 субайди, например subid1:subid2:subid3:subid4:subid5 (не обязательно)
        'site_key'  => '' // ключ
    ]
];


$infocdnJson = json_encode($infocdnData);

$handle = curl_init('http://infocdn.org/interface/api.php');
curl_setopt($handle, CURLOPT_POSTFIELDS, urlencode($infocdnJson));
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($handle);
curl_close($handle);

echo $result;