<?php
namespace App\Controllers;

use Xiaoler\Blade\FileViewFinder;
use Xiaoler\Blade\Factory;
use Xiaoler\Blade\Compilers\BladeCompiler;
use Xiaoler\Blade\Engines\CompilerEngine;
use Xiaoler\Blade\Filesystem;
use Xiaoler\Blade\Engines\EngineResolver;

abstract class Controller
{


    public function view($html, $vars = [])
    {
        $compiler = new BladeCompiler(ROOT_PATH . 'cache');
        $engine = new CompilerEngine($compiler);
        $finder = new FileViewFinder([ROOT_PATH . 'views']);
        $factory = new Factory($engine, $finder);
        echo $factory->make($html, $vars)->render();
        exit;
    }

    public function json($arr)
    {
        echo json_encode($arr);
        exit;
    }

}
