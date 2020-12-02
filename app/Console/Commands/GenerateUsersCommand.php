<?php

namespace App\Console\Commands;

use App\Services\Generators\UserGenerator;
use Illuminate\Console\Command;

class GenerateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:generate-users {count}';

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
     * @param UserGenerator $generator
     * @return void
     */
    public function handle(UserGenerator $generator)
    {
        $count = $this->argument('count');

        $local = storage_path('local');

        $names_file_content = file_get_contents($local.'/names.txt');
        $names = explode(',', $names_file_content);

        $surnames_file_content = file_get_contents($local.'/surnames.txt');
        $surnames = explode(',', $surnames_file_content);

        for ($i = 0; $i <= $count; $i++) {
            $name_rand_key = rand(0, count($names) - 1);
            $current_name = $names[$name_rand_key];

            $surname_rand_key = rand(0, count($surnames) - 1);
            $current_surname = $surnames[$surname_rand_key];

            $generator->generate($current_name, $current_surname);
        }
    }
}
