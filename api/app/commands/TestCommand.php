<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/*
Don't forget to add this command to start/artisan.php
Artisan::add( new TestCommand() );
 */

class TestCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'a convenient place for Joel to put little tests';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // put the example code here
        // $this->comment 
        // $this->info
        $this->comment('Class: ' . get_class(App::getFacadeRoot()));
        var_dump( App::getFacadeRoot() );
        // $this->info('Timezone: ' . (Config::get('app.timezone')));

        // $text = '{"errors":["this is a test","second test"]}';
        // $json = json_decode($text);
        // var_dump($json);
    } 

}