<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/11/18
 * Time: 9:54 AM
 */

namespace _namespace_\Http\Controllers\API;

use App\Http\Controllers\Controller;
use _namespace_\Http\Requests\_class_CreateRequest;
use _namespace_\Http\Requests\_class_UpdateRequest;
use _namespace_\Http\Resources\_class_Resource;
use _namespace_\Repositories\_class_Repository;
use Illuminate\Http\Request;
use Modularization\MultiInheritance\ControllersTrait;

class _class_APIController  extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(_class_Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data = $this->repository->myPaginate($input);
        return new _class_Resource($data);
    }

    public function create()
    {
        return view('_view_.create');
    }

    public function store(_class_CreateRequest $request)
    {
        $input = $request->all();
        $_var_ = $this->repository->store($input);
        return new _class_Resource($_var_);
    }

    public function show($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            return new _class_Resource([$_var_]);
        }
        return new _class_Resource($_var_);
    }

    public function edit($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            return new _class_Resource([$_var_]);
        }
        return new _class_Resource($_var_);
    }

    public function update(_class_UpdateRequest $request, $id)
    {
        $input = $request->all();
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            return new _class_Resource([$_var_]);
        }
        $data = $this->repository->change($input, $_var_);
        return new _class_Resource($data);
    }

    public function destroy($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            return new _class_Resource($_var_);
        }
        $data = $this->repository->delete($id);
        return new _class_Resource([$data]);
    }
}