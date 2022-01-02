<?php


namespace zafarjonovich\PHPSafeException\saver;


use zafarjonovich\PHPSafeException\base\Saver;

class TelegramBotSaver implements Saver
{
    private $token;
    private $chat_ids;

    public function __construct(string $token,array $chat_ids)
    {
        $this->token = $token;
        $this->chat_ids = $chat_ids;
    }

    public function save($convertedException)
    {
        foreach ($this->chat_ids as $chat_id) {
            $this->request(
                'sendMessage',
                [
                    'chat_id' => $chat_id,
                    'text' => (string)$convertedException
                ]
            );
        }
    }


    private function request($method,$options = [])
    {
        $url = "https://api.telegram.org/bot".$this->token . '/' . $method;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$options);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}