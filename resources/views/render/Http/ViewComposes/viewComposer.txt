<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 1/19/18
 * Time: 4:08 PM
 */

namespace _namespace_\ViewComposer;


use Illuminate\View\View;
use _namespace_\Repositories\_name_Repository;

class _name_Composer
{
    private $repository;

    public function __construct(_name_Repository $repository)
    {
        $this->repository = $repository;
    }

    public function compose(View $view)
    {
        return $view->with('_var_Compose', $this->repository->makeModel()->pluck(NAME_COL, ID_COL));
    }
}