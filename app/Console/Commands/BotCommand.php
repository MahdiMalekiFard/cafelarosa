<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Str;

class BotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot
                {model : Namespace action}
                {--except= : Except action - (i=index,s=store,S=seeder,u=update,d=delete,f=factory,r=resource,R=request,c=controller.php.stub,p=policy,y=Repository) - sample = isSu}
                {--t|toggle : Add toggle action}
                {--d|data : Add data needed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create multiple action';

    /** Execute the console command. */
    public function handle(): void
    {
        $model = $this->argument('model');
        $model = Str::studly($model);

        Artisan::call('app:model ' . $model);

        Artisan::call('app:action ' . $model . ' --type=Store');
        Artisan::call('app:test ' . $model . ' --type=Store');
        Artisan::call('app:action ' . $model . ' --type=Update');
        Artisan::call('app:test ' . $model . ' --type=Update');
        Artisan::call('app:action ' . $model . ' --type=Delete');
        Artisan::call('app:test ' . $model . ' --type=Delete');

        Artisan::call('app:permission ' . $model);
        Artisan::call('app:test ' . $model . ' --type=Show');
        Artisan::call('app:test ' . $model . ' --type=Index');

        if ($this->option('toggle')) {
            Artisan::call('app:action ' . $model . ' --type=Toggle');
            Artisan::call('app:test ' . $model . ' --type=Toggle');
        }

        if ($this->option('data')) {
            Artisan::call('app:action ' . $model . ' --type=Data');
            Artisan::call('app:test ' . $model . ' --type=Data');
        }

        Artisan::call('app:policy ' . $model);

        Artisan::call('app:resource ' . $model);

        Artisan::call('app:request-store ' . $model);
        Artisan::call('app:request-update ' . $model);

        Artisan::call('make:factory ' . $model . 'Factory');

        Artisan::call('make:provider RepositoryServiceProvider');

        Artisan::call('app:repository ' . $model);

        Artisan::call('app:lang ' . $model);

        Artisan::call('app:route ' . $model);

        Artisan::call('app:controller ' . $model);
        Artisan::call('app:admin-controller ' . $model);
        Artisan::call('app:admin-controller-views ' . $model);
        Artisan::call('app:a_search ' . $model);

        Artisan::call('app:policy ' . $model);
    }
}
