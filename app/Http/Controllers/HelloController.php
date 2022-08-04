<?php

namespace App\Http\Controllers;

class HelloController extends Controller
{
    public function __invoke()
    {
        return 'Goodbye';
    }
}
