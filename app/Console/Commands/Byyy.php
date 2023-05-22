<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Byyy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:byyy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Who's Byyy? Let Find It Out!";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        return $this->info('Byyy is Handsome People, Who Have a Beauty Girlfriend As Dentist At Special Region Of Yogyakarta');
    }
}
