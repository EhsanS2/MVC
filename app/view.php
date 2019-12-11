<?php

namespace App;

class View {
    public static function render($viewPath, $data) {
        $viewPath = str_replace('.', DS, $viewPath) . EXTENSION;
        $loader = new \Twig\Loader\FilesystemLoader(VIEWPATH);
        $twig = new \Twig\Environment($loader/*, [
            'cache' => '/path/to/compilation_cache',
        ]*/);
        echo $twig->render($viewPath, $data);
    }
}