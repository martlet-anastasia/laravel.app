<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test {name*?} {name2=test} {--Q|queue=default}';

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
     * @return int
     */
    public function handle() // здесь идет непосредственное выполнение
    {
//        $this->info('ololo');
//        $this->info(json_encode($this->argument('name') ?? 'no argument'));
//        $this->info($this->argument('name2') ?? 'no argument');
//        $this->info($this->option('queue'));
//        $this->line($this->option('queue'));
//        $this->error($this->option('queue'));

//        $answer = $this->ask('What do you want?');
//        $answer = $this->secret('What do you want?');
//        $answer = $this->confirm('What do you want?');
//        $answer = $this->confirm('What do you want?', true);
//        $answer = $this->anticipate('What do you want?', ['bbb', 'xxx', 'zzz']);
//        $answer = $this->choice('What do you want?', ['gfg', 'yty'], 0);

        $answer = $this->table(
            ['Name', 'Email'],
            User::all(['name', 'email'])->toArray()
        );


        $this->info($answer);
        //        $this->error('hghgh');
        return Command::SUCCESS;
    }
}
