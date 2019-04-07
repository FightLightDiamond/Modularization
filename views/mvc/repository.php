<?php

namespace _namespace_\Repositories;


use Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use _namespace_\Models\_class_;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class _class_RepositoryEloquent extends BaseRepository implements _class_Repository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return _class_::class;
    }

    public function myPaginate($input)
    {
        isset($input[PER_PAGE]) ?: $input[PER_PAGE] = 10;
        return $this->makeModel()
            ->filter($input)
            ->orderBy('id', 'DESC')
            ->paginate($input[PER_PAGE]);
    }

    public function store($input)
    {
        $input[CREATED_BY_COL] = auth()->id();
        return $this->create($input);
    }

    public function edit($id)
    {
        $_var_ = $this->find($id);
        if (empty($_var_)) {
            return $_var_;
        }
        return compact('_var_');
    }

    public function change($input, $data)
    {
        $input[UPDATED_BY_COL] = auth()->id();
        return $this->update($input, $data->id);
    }

    public function import($file)
    {
        set_time_limit(9999);
        $path = $this->makeModel()->uploadImport($file);
        return $this->importing($path);
    }

    private function standardized($input, $data)
    {
        return $data->uploads($input);
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
