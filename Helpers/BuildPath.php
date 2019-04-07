<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:08 PM
 */

namespace Modularization\Helpers;

use Modularization\Facades\FormatFa;

class BuildPath
{
    static function inRequest()
    {
        return (CRUDPath::viewPath() . '/mvc/request.php');
    }

    static function outRequest($table, $path = 'app')
    {
        return base_path($path . '/Http/Requests/' . FormatFa::formatAppName($table) . 'Request.php');
    }

    static function inController()
    {
        return (CRUDPath::viewPath() . '/mvc/controller.php');
    }

    static function outController($table, $path = 'app')
    {
        return base_path($path . '/Http/Controllers/' . FormatFa::formatAppName($table) . 'Controller.php');
    }

    static function inControllerApi()
    {
        return (CRUDPath::viewPath() . '/api/ApiCtrlController.php');
    }

    static function outControllerApi($table, $path = 'app')
    {
        return base_path($path . '/Http/Controllers/Api/' . FormatFa::formatAppName($table) . 'ApiController.php');
    }

    static function inViewComposer()
    {
        return (CRUDPath::viewPath() . '/mvc/viewComposer.php');
    }

    static function outViewComposer($table, $path = 'app')
    {
        return base_path($path . '/Http/ViewComposer/' . FormatFa::formatAppName($table) . 'Composer.php');
    }

    static function inInterface()
    {
        return (CRUDPath::viewPath() . '/mvc/interfaceRepo.php');
    }

    static function outInterface($table, $path = 'app')
    {
        return base_path($path . '/Repositories/' . FormatFa::formatAppName($table) . 'Repository.php');
    }

    static function inRepository()
    {
        return (CRUDPath::viewPath() . '/mvc/repository.php');
    }

    static function outRepository($table, $path = 'app')
    {
        return base_path($path . '/Repositories/' . FormatFa::formatAppName($table) . 'RepositoryEloquent.php');
    }

    static function inResource()
    {
        return (CRUDPath::viewPath() . '/api/Resource.php');
    }

    static function outResource($table, $path = 'app')
    {
        return base_path($path . '/Http/Resources/' . FormatFa::formatAppName($table) . 'Resource.php');
    }

    static function inPolicy()
    {
        return (CRUDPath::viewPath() . '/mvc/policy.php');
    }

    static function outPolicy($table, $path = 'app')
    {
        return base_path($path . '/Policies/' . FormatFa::formatAppName($table) . 'Policy.php');
    }

    static function inModel()
    {
        return (CRUDPath::viewPath() . '/models/model.php');
    }

    static function outModel($table, $path = 'app')
    {
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . '.php');
    }

    static function inMutator()
    {
        return (CRUDPath::viewPath() . '/models/mutator.php');
    }

    static function outMutator($table, $path = 'app')
    {
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . 'Mutator.php');
    }

    static function inAccessor()
    {
        return (CRUDPath::viewPath() . '/models/accessor.php');
    }

    static function outAccessor($table, $path = 'app')
    {
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . 'Accessor.php');
    }
}