<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/22
 * Time: 3:45
 */

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class ModelGenerator
{
    protected $file;

    public function __construct()
    {
        $this->file = app(Filesystem::class);
    }

    public function make($path)
    {
        $name = basename($path, '.php');
        $template = $this->getTemplate($name);


        if (!File::exists($path)) {
            return File::put($path, $template);
        }

        return false;
    }

    public function getTemplate($name)
    {
        $template = $this->file->get(__DIR__ . '/model.txt');

        return str_replace('{{name}}', $name, $template);
    }

}
