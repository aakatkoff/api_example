<?php

# Настройки из ad1.ru

// Буквенный идентификатор потока
$thread = '';

// Site key для отправки заявок
$siteKey = '';

// Дефолтное гео, для заявок в которых телефон указан НЕ в международном формате
$defaultRegion = 'RU';



# Настройки из ВК

// Строка для подтверждения адреса сервера из настроек Callback API
$confirmationToken = '';

// Секретный ключ
$secret = '';







if (!isset($_REQUEST)) {
    return;
}

// Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input'));

if ($data->secret != $secret) {
    return;
}

// Проверяем, что находится в поле "type"
switch ($data->type) {
    // Если это уведомление для подтверждения адреса...
    case 'confirmation':
        // отправляем строку для подтверждения
        echo $confirmationToken;
        break;

    // Если это уведомление о новом лиде
    case 'lead_forms_new':

        $leadId = $data->object->lead_id;
        $groupId = $data->object->group_id;
        $userId = $data->object->user_id;
        $formId = $data->object->form_id;
        $adId = !empty($data->object->ad_id) ? $data->object->ad_id : 0;

        $name = '';
        $phone = '';
        foreach ($data->object->answers as $answer) {
            if ($answer->key == 'first_name') {
                $name = $answer->answer;
            }

            if ($answer->key == 'phone_number') {
                $phone = $answer->answer;
            }
        }

        $data = [
            'thread'            => $thread,
            'site_key'          => $siteKey,
            'default_region'    => $defaultRegion,
            'subid'             => "group{$groupId}:form{$formId}:ad{$adId}:user{$userId}:lead{$leadId}",
            'phone'             => $phone,
            'name'              => $name,
        ];

        $curl = curl_init('http://infocdn.org/interface/vk.php');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);


        // Возвращаем "ok" серверу Callback API
        echo('ok');

        break;
}
