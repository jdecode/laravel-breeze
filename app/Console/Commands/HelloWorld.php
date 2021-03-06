<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HelloWorld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hello World : Testing queus with GCP Cloud Tasks';

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
     * @return int
     */
    public function handle()
    {
        Log::info('Hello World : Log Info!');
        Log::log('debug', 'Hello World : Log debug, using log method!');
        $u = new User();
        $u->name = 'Command Testing';
        $u->email = rand() . '-command@testing.io';
        $u->password = bcrypt('commandtesting');
        $u->save();
        print('Hello World : print!');
        return 0;
    }
}
