<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class EmailService
{
    /**
     * Send an email.
     */
    public static function send(Mailable $mailable): bool
    {
        try {
            Mail::send($mailable);
            return true;
        } catch (\Exception $e) {
            \Log::error("Error on sending email: " . $e->getMessage());
            return false;
        }
    }
}