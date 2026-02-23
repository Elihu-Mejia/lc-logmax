<?php

namespace App\Http\Controllers;


abstract class Controller
{
    public function printy() {
        $this->Log::info('Hi there!');
    }
}


