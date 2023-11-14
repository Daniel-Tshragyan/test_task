<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static import()
 * @method static prepareData()
 * @method static getImportInfo()
 * @method static createItems()
 * @method static getUpdateDataCount()
 * @method static getUsersListFromAPI()
 */

class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'userServiceFacade';
    }
}
