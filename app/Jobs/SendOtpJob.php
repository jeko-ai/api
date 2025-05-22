<?php

namespace App\Jobs;

use Exception;
use Ichtrojan\Otp\Otp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOtpJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $email)
    {
        //
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        $otp = (new Otp)->generate($this->email, 'numeric', 6);
        if ($otp->status) {
            Mail::mailer('otp_smtp')->send('emails.verify-email', [
                'otp' => $otp->token,
                'email' => $this->email
            ], function ($message) {
                $message->from('otp@kira.ws', 'Kira')
                    ->to($this->email)
                    ->subject('Verify your email address');
            });
        }
    }
}
