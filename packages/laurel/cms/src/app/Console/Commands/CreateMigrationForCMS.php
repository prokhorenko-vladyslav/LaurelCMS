<?php

namespace Laurel\CMS\Console\Commands;

use Illuminate\Console\Command;
use Laurel\CMS\LaurelCMS;

class CreateMigrationForCMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laurel\cms\make:migration {name} {--path=}';

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
    public function handle()
    {
        $migrationPath = LaurelCMS::instance()->getRelativeRoot() . '/../database/migrations/' . ($this->option('path') ?? '');
        if (!file_exists($migrationPath)) {
            mkdir($migrationPath, 0777, true);
        }

        $this->call('make:migration', [
            'name' => $this->argument('name'),
            '--path' => $migrationPath,
            '--fullpath' => true
        ]);
        return 0;
    }
}
