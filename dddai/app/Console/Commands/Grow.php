<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Grow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->line('hello artisan');
        $this->error('hello artisan');
        $this->info('hello artisan');
        $this->question('hello artisan');
        $this->comment('hello artisan');
    }
}
