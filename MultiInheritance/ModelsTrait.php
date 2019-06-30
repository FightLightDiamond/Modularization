<?php

/**
 * Created by PhpStorm.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace Modularization\MultiInheritance;

use App\User;
use Modularization\Facades\FormatFa;
use Uploader\UploadAble;

trait ModelsTrait
{
    use UploadAble;

    //=====================RELATION============================>

    public function creator()
    {
        return $this->belongsTo(User::class, CREATED_BY_COL);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, UPDATED_BY_COL);
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

    private $where = [];
    private $whereIn = [];

    public function scopeFilter($query, $input)
    {
        foreach ($this->whereIn as $key => $value) {
            if (isset($input[$value])) {
                $query->whereIn($this->table . '.' . $key, $input[$value]);
            }
        }
        foreach ($this->where as $value) {
            if (isset($input[$value])) {
                $query->where($this->table . '.' . $value, $input[$value]);
            }
        }
        return $query;
    }

//    public function getImage($img)
//    {
//        return config('app.asset_url') . ("/storage{$img}");
//    }
//
//    public function getThumbPath($img, $sizes)
//    {
//        $sizeImage = '_' . implode('_', $sizes) . '.';
//        $img = str_replace('.', $sizeImage, $img);
//        return $this->getImage($img);
//    }
}