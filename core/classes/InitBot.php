<?php

namespace Bot;

use Couchbase\User;

class InitBot
{
    const START_COMMAND = '/start';
    const CHANGE_LANG_COMMAND = '/lang';
    const CONTACT_COMMAND = '/contact';
    const HELP_COMMAND = '/help';
    const BUG_REPORT = '/report';

    public $body;

    protected $telegram_api_url = 'https://api.telegram.org/bot';
    protected $telegram_api_key = '5327697213:AAFJV6ZkuAgu5cYlofFYaiMGKf2rVy5TtIU';

    function __construct($data)
    {
        $this->getInputParams($data);
    }

    protected function getInputParams($data): void
    {
        $body = json_decode($data, true);

        $this->body = array(
            'chatId' => $body['message']['chat']['id'],
            'text' => $body['message']['text'],
            'user_data' => array(
                'telegram_id' => $body['message']['chat']['id'],
                'username' => $body['message']['chat']['username'],
            )
        );

//        $this->body = array(
//            'chatId' => 1282631282,
//            'text' => 'test',
//            'user_data' => array(
//                'telegram_id' => 1282631282,
//                'username' => 'stayhome2021',
//            )
//        );
    }

    /**
     * @param $text
     * @param $chatId
     * @return void
     */
    public function sendMessage($text, $chatId = ''): void
    {
        $method = '/sendMessage';
        $url = $this->telegram_api_url . $this->telegram_api_key . $method;

        $params = http_build_query(array(
            'chat_id' => $chatId ? $chatId : $this->body['chatId'],
            'text' => $text,
            'parse_mode' => 'HTML'
        ));

        sendPostRequest($url, false, $params);
    }

    public function useAction()
    {
        global $TEXT;

        $Translit = new Translit($this->body['text']);
        $Users = new Users($this->body['user_data'], $this->body['text']);

        $language = $Users->language;

        $convertedArmenianText = $Translit->convertTranslit2Armenian();

        if ($this->body['text'] == self::START_COMMAND)
            $this->sendMessage($TEXT['start_message'][$language]);
        elseif ($this->body['text'] == self::CONTACT_COMMAND)
            $this->sendMessage($TEXT['contact_message'][$language]);
        elseif ($this->body['text'] == self::HELP_COMMAND)
            $this->sendMessage($TEXT['help_message'][$language]);
        elseif ($this->body['text'] == self::CHANGE_LANG_COMMAND)
            $Users->changeLanguage($this->body['chatId']);
        elseif ($this->body['text'] == self::BUG_REPORT) {}
            //bug report here
        else
            new YandexTranslator($this->body, $convertedArmenianText, $language);
    }
}