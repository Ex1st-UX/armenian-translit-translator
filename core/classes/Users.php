<?php

namespace Bot;

class Users extends InitBot
{
    protected $user_data;

    public $language;
    public $Users;
    public $body;

    function __construct($user_data, $user_message)
    {
        $this->user_data = $user_data;

        $this->setActivity();

        $this->logUserMessage($user_message);
        $this->setLanguage();
    }

    /*
     * write new user or set activity if user exist
    */
    protected function setActivity()
    {
        if (\R::findOne('users', 'telegram_id = ?', [$this->user_data['telegram_id']]))
            $this->Users = \R::findOne('users', 'telegram_id = ?', [$this->user_data['telegram_id']]);
        else
            $this->Users = \R::dispense('users');

        $this->Users->telegram_id = $this->user_data['telegram_id'];
        $this->Users->username = $this->user_data['username'];
        $this->Users->last_activity = date("Y-m-d H:i:s");

        \R::store($this->Users);
    }

    /**
     * @param $chatId
     * @return void - send message with current language
     */
    public function changeLanguage($chatId): void
    {
        if ($this->Users->lang == 'ru')
            $this->Users->lang = 'en';
        elseif ($this->Users->lang == 'en')
            $this->Users->lang = 'ru';

        \R::store($this->Users);

        $this->setLanguage();

        $this->sendMessage($this->language, $chatId);
    }

    protected function setLanguage()
    {
        $this->language = $this->Users->lang;
    }

    protected function logUserMessage($text)
    {
        if ($text) {
            $Messages = \R::dispense('messages');

            $Messages->user_id = $this->Users->id;
            $Messages->message = strval(trim($text));
            $Messages->datetime = date("Y-m-d H:i:s");

            \R::store($Messages);
        }
    }
}