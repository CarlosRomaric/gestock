<?php

namespace App;

 class  Message{

    private static $base_url = "http://badev.lorbouor.org/api/v1/sms";

    private static $email = "infos@icoopaci.ci";
    
    private static $password = "6&ml43eH";

    private $cellphones = [];

    private $message_content = "";

    /**
     * Constructeur
     * @param Array $cellphones Liste des numéros 
     * @param String $messageContent Contenu du message
     */
    public function __construct(Array $cellphones=[], $messageContent="")
    {
        $this->cellphones = $cellphones;
        $this->message_content = $messageContent;
    }
   

    /**
     * Getter and Setter Cellphone
     */
    public function setCellphones($cellphones){ $this->cellphones = $cellphones; }
    public function getCellphones($cellphones){ return $this->cellphones; }

    /**
     * Getter and Setter MessageContent
     */
    public function setMessage($message){ $this->message_content = $message; }
    public function getMessage($message){ return $this->message_content; }

    private function initTransaction($phone, $content)
    {
        $params = [
            'email'=>'infos@icoopaci.ci',
            'password'=>'6&ml43eH',
            'cellphone'=>$phone,
            'message_content'=>$content,
        ];
        $query_content = http_build_query($params);
        $fp = fopen(Message::$base_url, 'r', FALSE, // do not use_include_path
            stream_context_create([
            'http' => [
            'header'  => [ // header array does not need '\r\n'
                'Content-type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($query_content)
            ],
            'method'  => 'POST',
            'content' => $query_content
            ]
        ]));
        if ($fp === FALSE) {
            fclose($fp);
            return json_encode(['cellphone'=>$phone,'error' => 'Failed to get contents...']);
        }
        $result = stream_get_contents($fp); // no maxlength/offset
        fclose($fp);
        return $result;
    }

    /**
     * Envoyer les messages à la liste de numéro
     * return Array
     */
    public function send()
    {
        $results = [];
        foreach ($this->cellphones as $phone) {
            array_push($results, $this->initTransaction($phone, $this->message_content));
        }
        return $results;
    }
}


