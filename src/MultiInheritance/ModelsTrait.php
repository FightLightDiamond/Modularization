<?php

/**
 * Created by cuongpm/modularization.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace Cuongpm\Modularization\MultiInheritance;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Cuongpm\Modularization\Http\Facades\FormatFa;
use Cuongpm\Uploader\UploadAble;

const SORT_FILTER = 'sort';
const MY_FILTER = 'my';
const RANDOM_ORDER_FILTER = '{randomOrder}';
const RELATIONSHIP_FILTER = '{relationship}';

trait ModelsTrait
{
    use UploadAble;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function creatorName($field = 'email')
    {
        if ($this->creator) {
            return $this->creator->$field;
        }
        return '--';
    }

    public function updaterName($field = 'email')
    {
        if ($this->updater) {
            return $this->updater->$field;
        }
        return '--';
    }

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

            if ($field === SORT_FILTER) {
                $query->sortBy($value);
                continue;
            }

            if ($field === MY_FILTER) {
                $query->my();
                continue;
            }

            if ($field === RELATIONSHIP_FILTER) {
                $query->with($value);
                continue;
            }

            if ($field === RANDOM_ORDER_FILTER) {
                $query->inRandomOrder();
                continue;
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
        foreach ($input as $field => $sortBy) {
            $query->orderBy($this->table . '.' . $field, $sortBy);
        }

        return $query;
    }

    public function scopeMy($query, $field = 'user_id')
    {
        if (in_array($field, $this->fillable)) {
            return $query->where($this->table . '.' . $field, Auth::id());
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

        return storage_path("app/{$this->table}/{$newName}");
    }
}
