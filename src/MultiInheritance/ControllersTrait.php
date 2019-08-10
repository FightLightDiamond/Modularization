<?php
/**
 * Created by PhpStorm.
 * User: e
 * Date: 1/7/17
 * Time: 1:40 PM
 */

namespace Modularization\MultiInheritance;


use Illuminate\Http\Request;

trait ControllersTrait
{
    public function lists(Request $request)
    {
        $input = $request->all();
        return $this->repository->filterList($input);
    }

    function isBack()
    {
        if (request()->get('is_back')) {
            return redirect()->back()->withInput();
        }
    }

    public function sort(Request $request)
    {
        $ids = $request->get('ids');
        foreach ($ids as $key => $id) {
            $this->repository->update(['no' => $key + 1], $id);
        }
        return response()->json(true);
    }
}