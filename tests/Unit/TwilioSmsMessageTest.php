<?php

namespace NotificationChannels\Twilio\Tests\Unit;

use NotificationChannels\Twilio\TwilioSmsMessage;
use PHPUnit\Framework\Attributes\Test;

class TwilioSmsMessageTest extends TwilioMessageTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->message = new TwilioSmsMessage;
    }

    #[Test]
    public function it_can_accept_a_message_when_constructing_a_message()
    {
        $message = new TwilioSmsMessage('myMessage');

        $this->assertEquals('myMessage', $message->content);
    }

    #[Test]
    public function it_provides_a_create_method()
    {
        $message = TwilioSmsMessage::create('myMessage');

        $this->assertEquals('myMessage', $message->content);
    }

    #[Test]
    public function it_sets_alphanumeric_sender()
    {
        $message = TwilioSmsMessage::create('myMessage');
        $message->sender('TestSender');

        $this->assertEquals('TestSender', $message->alphaNumSender);
    }

    #[Test]
    public function it_can_return_the_alphanumeric_sender_if_set()
    {
        $message = TwilioSmsMessage::create('myMessage');
        $message->sender('TestSender');

        $this->assertEquals('TestSender', $message->getFrom());
    }

    #[Test]
    public function it_can_return_the_messaging_service_sid_if_set()
    {
        $message = TwilioSmsMessage::create('myMessage');
        $message->messagingServiceSid('TestSid');

        $this->assertEquals('TestSid', $message->getMessagingServiceSid());
    }

    #[Test]
    public function it_can_set_optional_parameters()
    {
        $message = TwilioSmsMessage::create('myMessage');
        $message->statusCallback('http://example.com');
        $message->statusCallbackMethod('PUT');
        $message->applicationSid('ABCD1234');
        $message->maxPrice(0.05);
        $message->provideFeedback(true);
        $message->validityPeriod(120);

        $this->assertEquals('http://example.com', $message->statusCallback);
        $this->assertEquals('PUT', $message->statusCallbackMethod);
        $this->assertEquals('ABCD1234', $message->applicationSid);
        $this->assertEquals(0.05, $message->maxPrice);
        $this->assertEquals(true, $message->provideFeedback);
        $this->assertEquals(120, $message->validityPeriod);
    }
}
