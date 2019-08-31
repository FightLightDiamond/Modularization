<?php

/**
 * Created by cuongpm/modularization.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace Modularization\MultiInheritance;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modularization\Http\Facades\FormatFa;
use Uploader\UploadAble;

trait ModelsTrait
{
    use UploadAble;

    //======================SCOPE===============================>

    public function scopeFilter($query, $params)
    {
        foreach ($params as $field => $value) {
            if ($value === '' || $value === null) {
                continue;
            }

            $method = 'filter' . Str::studly($field);

            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }

            if (in_array($field, $this->fillable, true)) {
                $query->where($this->table . '.' . $field, $value);
                continue;
            }

            if($field === 'sort') {
                $query->sortBy($value);
            }
        }

        return $query;
    }

    public function scopeSortBy($query, $value)
    {
        $sorts = explode('|', $value);

        return $query->orderBy($sorts[0], $sorts[1]);
    }

    public function scopeOrders($query, $input = [])
    {
        foreach ($input as $field => $value) {
            $query->orderBy($this->table . '.' . $field, $value);
        }

        return $query;
    }

    //========================ACTION============================>

    public function checkbox($input)
    {
        if (isset($this->checkbox)) {
            foreach ($this->checkbox as $value) {
                (isset($input[$value]) && $input[$value] !== '0') ? $input[$value] = 1 : $input[$value] = 0;
            }
        }
        return $input;
    }

    public function uploadImport($file)
    {
        $newName = FormatFa::reFileName($file);
        $file->storeAs(
            $this->table, $newName
        );
        return storage_path('app/' . $this->table . '/' . $newName);
    }

    public function scopeRelation($query, $input)
    {
        if (isset($input['relations'])) {
            foreach ($input['relations'] as $relation) {
                $query->with($relation);
            }
        }
        return $query;
    }

    public function scopeMy($query, $field = 'user_id')
    {
        if(in_array($field, $this->fillable)) {
            return $query->where($this->table . '.' . $field, Auth::id());
        }

        return $query;
    }
}