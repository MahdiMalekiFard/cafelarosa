<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class MakeAdminControllerViewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin-controller-views
    {model : Namespace action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** Execute the console command. */
    public function handle()
    {
        $model = $this->argument('model');
        $model = Str::studly($model);

        $files = array_diff(scandir(__DIR__ . '/stubs/views', SCANDIR_SORT_ASCENDING), ['.', '..']);
        foreach ($files as $name) {
            $content_controller = file_get_contents(__DIR__ . '/stubs/views/' . $name);
            $content_controller = str_replace(
                [
                    '{{model}}',
                    '{{kmodel}}',
                    '{{cmodel}}',
                    '{{smodel}}',
                ],
                [
                    $model,
                    Str::kebab($model),
                    Str::camel($model),
                    Str::snake($model),
                ],
                $content_controller
            );
            $path = base_path('resources/views/admin/pages/' . Str::camel($model));
            if ( ! is_dir($path) && ! mkdir($path, 0775) && ! is_dir($path)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
            if ( ! file_exists($path . '/' . str_replace('stub', 'blade.php', $name))) {
                File::put($path . '/' . str_replace('stub', 'blade.php', $name), $content_controller);
            }
        }
    }
}
