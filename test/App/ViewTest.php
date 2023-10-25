<?php

namespace dokterkepin\media\App;

use dokterkepin\media\App\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender(){
        View::render("Home/index", [
            "title" => "Login"
        ]);

        $this->expectOutputRegex("[html]");
        $this->expectOutputRegex("[Welcome, Login]");
        $this->expectOutputRegex("[Password]");
    }

}
