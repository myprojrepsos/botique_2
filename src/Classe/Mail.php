<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;
use Symfony\Component\Dotenv\Dotenv;

class Mail
{

    //private $api_key = ;

    //private $api_key_secret = ;

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->getApiKey(), $this->getApiSecret(), true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "seppeo.game@gmail.com",
                        'Name' => "Boutique Sếp péo"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 2088728, //ID du modèle de TemplateID
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }

    private function getApiKey(){
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        return $_ENV["MAILJET_KEY"];
    }

    private function getApiSecret(){
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        return $_ENV["MAILJET_KEY_SECRET"];
    }
}
