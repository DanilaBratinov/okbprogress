<?php

$error = true;
$secret = '6LeK3R0qAAAAAOpjXaFV8-L3lHaWA9L0p_UgkVID';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!empty($_POST['g-recaptcha-response'])) {
    $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $out = curl_exec($curl);
    curl_close($curl);

    $out = json_decode($out);
    if ($out->success == false) {
        $error = true;

    }

    if ($out->success == true) {
        $error = false;


    $botToken = "7206460578:AAEyMW-uWRX-ZCgzTn1ufqHq5eSULkqbVhU";

        $botUrl = "https://api.telegram.org/bot" . $botToken . "/sendMessage";

        $form = $_POST['form_id'];
        $service = $_POST['service_id'];
        $name = $_POST['name_id'];
        $email = $_POST['mail_id'];
        $phone = $_POST['phone_id'];
        $message = $_POST['comment_id'];
        $unit = $_POST['unit_id'];
        $power = $_POST['power_id'];
        $ip = $_POST['ip_id'];
        $router = $_POST['checkbox_id'];
        $speed = $_POST['speed_id'];

        $telegramMessage .= "*Новая заявка*\n\n";

        if (!empty($service)) {
            $telegramMessage .= "Услуга: " . $service . "\n\n";
        }

        if (!empty($form)) {
            $telegramMessage .= "Услуга: " . $form . "\n\n";
        }

        $telegramMessage .= "Имя: " . $name . "\n";
        $telegramMessage .= "Телефон: " . $phone . "\n";
        $telegramMessage .= "Email: " . $email . "\n\n";

        if (!empty($message)) {
            $telegramMessage .= "Сообщение: " . $message . "\n\n";
        }
        if (!empty($unit)) {
            $telegramMessage .= "Кол-во юнитов: " . $unit . "\n";
        }
        if (!empty($power)) {
            $telegramMessage .= "Суммарная мощность БП: " . $power . "\n";
        }
        if (!empty($ip)) {
            $telegramMessage .= "Кол-во IP: " . $ip . "\n";
        }
        if (!empty($router)) {
            $telegramMessage .= "Свой маршрутизатор: Да\n";
        }
        if (!empty($speed)) {
            $telegramMessage .= "Скорость канала: " . $speed . " Мб/с\n";
        }

        $ch = curl_init($botUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id=351661463&text=" . urlencode($telegramMessage) . "&parse_mode=Markdown");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            echo "Сообщение успешно отправлено!";
        } else {
            echo "Ошибка отправки сообщения";
        }
    }
}
if ($error) {
    header('Location: ../error.html');
}
?>