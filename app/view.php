<?php

namespace App;

/*we have just one view class (no extended class)
per each controller we have a directory inside 'view' directory
and we have a file per each action in lowercase
for other parts we have 'partials', inside a directory if it's belong to that controller
and inside 'view' directory if it's general*/

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