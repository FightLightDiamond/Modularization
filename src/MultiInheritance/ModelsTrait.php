<?php

/**
 * Created by PhpStorm.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace Modularization\MultiInheritance;

use App\User;
use Illuminate\Support\Facades\Auth;
use Modularization\Http\Facades\FormatFa;
use Uploader\UploadAble;

trait ModelsTrait
{
    use UploadAble;

    //=====================RELATION============================>

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