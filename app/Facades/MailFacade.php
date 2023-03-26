<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class MailFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'kayMailFacade';
    }

}
