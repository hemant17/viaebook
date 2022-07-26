<?php
namespace App\Packt\Facedes;

use Illuminate\Support\Facades\Facade;

class Packt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'packt';
    }
}