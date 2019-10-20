<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;


use Modularization\Core\Components\Http\Controllers\APICtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;

class APICtrlFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $auth = 'API';
    protected $sortPath = '/Http/Controllers';
    protected $fileName = 'APIController.php';

    public function __construct(APICtrlComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $material = $this->component->building($input);
        $this->produce($material, $input['path']);
    }
}
