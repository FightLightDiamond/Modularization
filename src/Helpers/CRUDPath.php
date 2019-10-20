<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/13/17
 * Time: 5:21 PM
 */

namespace Modularization\Helpers;

use Modularization\src\Helpers\BuildInput;

class CRUDPath
{
    static function viewPath() {
        return dirname(__DIR__) . ('/views');
    }
    static function inConstant()
    {
        return (self::viewPath() . '/const/DBConst.txt');
    }

    static function outConstant($table, $path = 'app')
    {
        return base_path('Constants/' . $table . 'db.php');
    }

    static function inCreateForm()
    {
        return (self::viewPath() . '/form/horizontal.html');
    }

    static function outCreateForm($table, $path = 'app')
    {
        $path = base_path($path . '/' . $table);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return base_path($path . '/' . $table . '/create.blade.php');
    }

    static function inIndexForm()
    {
        return (self::viewPath() . '/form/index.html');
    }

    static function outIndexForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/index.blade.php');
    }

    static function inTableForm()
    {
        return (self::viewPath() . '/form/table.html');
    }

    static function outTableForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/table.blade.php');
    }

    static function inUpdateForm()
    {
        return (self::viewPath() . '/form/update.html');
    }

    static function outUpdateForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/update.blade.php');
    }

    static function inShowForm()
    {
        return (self::viewPath() . '/form/show.html');
    }

    static function outShowForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/show.blade.php');
    }

    /**
     * Design patent
     */
    static function inObserver()
    {
        return (self::viewPath() . '/design_patent/observer.txt');
    }

    static function outObServer($table, $path = 'app')
    {
        return app_path('Observers/' . BuildInput::classe($table) . 'Observer.php');
    }

    /**
     *Ng
     */
    static function inNgFormBuilder()
    {
        return (self::viewPath() . '/ng/form/builder.txt');
    }

    static function outNgFormBuilder($table, $path = 'app')
    {
        return base_path('tsc/form/' . $table . '.ts');
    }

    static function inTransLabel()
    {
        return (self::viewPath() . '/trans/label.php');
    }

    static function outTransLabel()
    {
        return base_path('/Constants/label.php');
    }

    static function inTransTable()
    {
        return (self::viewPath() . '/trans/table.php');
    }

    static function outTransTable()
    {
        return base_path('/Constants/table.php');
    }
}