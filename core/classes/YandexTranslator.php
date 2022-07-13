<?php

namespace Bot;

class YandexTranslator extends InitBot
{
    protected $api_key = 'AQVNz5lMcC_3mCBvC81mg2hNme11FrZpP-Kf5i2b';
    protected $url = 'https://translate.api.cloud.yandex.net/translate/v2/';
    protected $folder_id = 'b1gbrtuo0ikqcmpvob79';
    protected $target_lang = 'ru';
    protected $source_lang = 'hy';

    protected $headers = array();
    protected $post_data = array();

    /**
     * @param $body - body from telegram
     * @param $convertedArmenianText - armenian language text
     * @param $language - current language
     */
    function __construct($body, $convertedArmenianText, $language)
    {
        $this->body = $convertedArmenianText;
        $this->target_lang = $language;
        
        $this->translate($body['chatId']);
    }

    public function translate($chatId)
    {
        $method = 'translate';

        $this->generateHeaders();
        $this->generateBody();

        $response = sendPostRequest($this->url . $method, $this->headers, $this->post_data);

        if ($response) {
            $response = (array) $response;
            $response = $response['translations'][0];
            $response = (array) $response;

            $response['text'] .= "\n__________________________________\n\n";
            $response['text'] .= $this->body;
        }
        else {
            $response['text'] = 'Перевести не удалось';
        }

        $this->sendMessage($response['text'], $chatId);
    }

    protected function generateHeaders(): void
    {
        $this->headers = array(
            'Content-Type: application/json',
            "Authorization: Api-key " . $this->api_key
        );
    }

    protected function generateBody(): void
    {
        $this->post_data = json_encode(array(
            "targetLanguageCode" => $this->target_lang,
            "sourceLanguageCode" => $this->source_lang,
            "texts" => strval($this->body),
            "folderId" => $this->folder_id
        ));
    }
}