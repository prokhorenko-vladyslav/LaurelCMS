<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AppInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App initialization';

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
    	phpinfo();die;
        /*$this->calcTimeFor('http://fast-action.utest.space/', 100);
        $this->calcTimeFor('http://laurel.cms.loc/api/modules/page', 100);
        $this->calcTimeFor('http://fast-action.utest.space/', 100, true);*/
        $this->calcTimeFor('http://laurel.cms.loc/api/modules/page', 100, true);

        /*Artisan::call('migrate:fresh --seed');
        print Artisan::output();
        Artisan::call('passport:install');
        print Artisan::output();*/
        return 0;
    }

    protected function calcTimeFor(string $url, int $requestsCount, bool $isAsync = false)
    {
        $client = new Client;
        $startTime = microtime(true);
        if ($isAsync) {
            $this->getAsync($url, $requestsCount, $client);
        } else {
            $this->get($url, $requestsCount, $client);
        }
        $endTime = microtime(true) - $startTime;
        $this->info("{$requestsCount} requests for \"{$url}\" has ended by {$endTime} seconds");
    }

    protected function getAsync(string $url, int $requestsCount, Client $client)
    {
        $promises = [];
        for($i = 0; $i < $requestsCount; $i++)
        {
            $promises[] = $client->getAsync($url);
        }
        $responses = Utils::settle($promises)->wait();
        return ;
    }

    protected function get(string $url, int $requestsCount, Client $client)
    {
        $promises = [];
        for($i = 0; $i < $requestsCount; $i++)
        {
            $promises[] = $client->get($url);
        }
        return ;
    }
}
