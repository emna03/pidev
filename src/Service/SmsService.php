<?php

namespace App\Service;

use Twilio\Rest\Client;

class SmsService
{
    private $client;
    private $from;

    public function init(string $twilioSid, string $twilioToken, string $fromNumber): void
    {
        $this->client = new Client($twilioSid, $twilioToken);
        $this->from = $fromNumber;
    }
    public function send(string $to, string $message): void
    {
        $this->client->messages->create(
            $to,
            [
                'from' => $this->from,
                'body' => $message
            ]
        );
    }
}
