<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $email = new SendEmail($details);
        Mail::to($this->details['email'])->send(new SendEmail($this->details));
        
//        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
//                $message->to($to_email, $to_name)
//                        ->subject('Your Password Reset Token');
//                $message->from('aseladss@gmail.com', 'Rental Database');
//            });
    }
}
