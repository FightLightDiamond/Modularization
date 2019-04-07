<?php

namespace _namespace_\Http\Controllers;

use App\Http\Controllers\Controller;
use _namespace_\Http\Requests\_class_CreateRequest;
use _namespace_\Http\Requests\_class_UpdateRequest;
use _namespace_\Repositories\_class_Repository;
use Illuminate\Http\Request;
use Modularization\MultiInheritance\ControllersTrait;

class _class_Controller extends Controller
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
        $data['_vars_'] = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('_view_.table', $data)->render();
        }
        return view('_view_.index', $data);
    }

    public function create()
    {
        return view('_view_.create');
    }

    public function store(_class_CreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('_route_.index');
    }

    public function show($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('_view_.show', compact('_var_'));
    }

    public function edit($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('_view_.update', compact('_var_'));
    }

    public function update(_class_UpdateRequest $request, $id)
    {
        $input = $request->all();
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $_var_);
        session()->flash('success', 'update success');
        return redirect()->route('_route_.index');
    }

    public function destroy($id)
    {
        $_var_ = $this->repository->find($id);
        if (empty($_var_)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
