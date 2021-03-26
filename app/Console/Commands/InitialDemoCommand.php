<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitialDemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:version1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a demonstration version 1 of the Juntos database application.';

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
        $this->line('Welcome to the Juntos Demo command.');


        //Migrations.
       if( $this->confirm('Do you want to run all migrations for the demo?',false))
       {
            //Run ALL migrations.
            $this->call('migrate');
           
       }
       else{
            $this->line('No migrations run');
        }
       
       //Demo record seeding.
        if( $this->confirm('Do you want to populate the demo with information?',false))
       {
        
            $this->call("db:seed",['--class'=>'SchoolSeeder']);
            $this->call("db:seed",['--class'=>'ParentsSeeder']);
            $this->call("db:seed",['--class'=>'StudentSeeder']);
            $this->call("db:seed",['--class'=>'EventSeeder']);
            $this->call("db:seed",['--class'=>'RoleSeeder']);
            $this->call("db:seed",['--class'=>'DemoUsers']);
                
       }
       else{
            $this->line('No population of data run');
        }
    }
}



