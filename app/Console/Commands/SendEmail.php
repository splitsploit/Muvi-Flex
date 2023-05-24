<?php

namespace App\Console\Commands;

use App\Mail\MailTest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an Email Testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emailTo = $this->ask('Where Email Must Be Send?');

        Mail::to($emailTo)->send(new MailTest);

        return $this->info('Email Has Been Sent to'. $emailTo);
    }
}
