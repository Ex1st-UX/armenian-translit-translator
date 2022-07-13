<?php

function checkTelegramConnection($telegramBody)
{
    if (empty($_POST))
        die();
}

/**
 * @param $url - request url
 * @param $headers - request headers
 * @param $body - request body
 * @return mixed - request result
 */
function sendPostRequest($url, $headers = false, $body)
{
    $curl = curl_init();

    if ($headers)
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result);
}

function dump_message($text)
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/core/logs/message.txt', print_r($text, true));
}
