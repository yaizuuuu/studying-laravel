<?php

namespace App\Console\Commands;

use App\Services\ModelGenerator;
use Illuminate\Console\Command;

class UserCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generateModel {name} {-p|--path=app/Eloquent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new model.';

    protected $generator;

    /**
     * Create a new command instance.
     *
     * UserCreatorCommand constructor.
     * @param ModelGenerator $model_generator
     */
    public function __construct(ModelGenerator $model_generator)
    {
        parent::__construct();

        $this->generator = $model_generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->getPath();

        if ($this->generator->make($path)) {
            $this->info("Created {$path}");
        } else {
            $this->error("Could not create {$path}");
        }


    }

    public function getPath()
    {
        return $this->option('path') . '/' . ucwords($this->argument('name')) . '.php';
    }
}
