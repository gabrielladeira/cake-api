<?php

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailService;
use Illuminate\Mail\Mailable;

class EmailServiceTest extends TestCase 
{
    public function test_send_email_successfully()
    {
        Mail::fake();
        $mailable = $this->createMock(Mailable::class);

        $result = EmailService::send($mailable);

        Mail::assertSent(get_class($mailable));
        $this->assertTrue($result);
    }

    public function test_send_email_fails()
    {
        Mail::shouldReceive('send')->andThrow(new \Exception('An error occurrs'));
        $mailable = $this->createMock(Mailable::class);

        $result = EmailService::send($mailable); 

        $this->assertTrue($result === false);
    }
}