<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class SendEmailMessageHandler 
{
    public function __invoke(SendEmailMessage $message)
    {
        // 1. create a PDF note
        echo 'creating a PDF note...<br>';

        // 2. Email the note
        echo 'Emailing note to ' . $message->getLivraisonId()->getBuyer()->getEmail() . '<br>';
    }
}
