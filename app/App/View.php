<?php

namespace dokterkepin\media\App;

class View
{
    static function render(string $view, array $model): void{
        require __DIR__ . "/../View/header.php";
        require __DIR__ . "/../View/$view.php";
        require __DIR__ . "/../View/footer.php";
    }

    static function redirect(string $url){
        header("Location: $url");

        if(getenv("mode") !="test"){
            exit();
        }
    }
}