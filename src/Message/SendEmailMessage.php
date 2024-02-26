<?php

namespace App\Message;

use Serializable;

class SendEmailMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

    private $livraisonId;

    public function __construct(int $livraisonId)
    {
         $this->livraisonId = $livraisonId;
    }

   public function getLivraisonId(): int
    {
       return $this->livraisonId;
    }
}
