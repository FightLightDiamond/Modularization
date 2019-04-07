<?php

/**
 * Created by PhpStorm.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace Modularization\MultiInheritance;

use App\User;
use Illuminate\Support\Facades\Log;
use Modularization\Core\Events\LogUploadEvent;
use Modularization\Facades\FormatFa;
use Modularization\Facades\UploadFa;

trait ModelsTrait
{
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

    public function uploads($input)
    {
        $folder = '';
        if (isset($this->fileUpload)) {
            foreach ($this->fileUpload as $name => $type) {
                if (isset($input[$name])) {
                    $input = $this->doing($input, $name, $folder, $type);
                }
            }
        }
        return $input;
    }

    private function doing($input, $name, $folder, $type)
    {
        if (is_array($input[$name])) {
            $input = $this->multi($input, $name, $folder, $type);
        } else {
            if (is_file($input[$name])) {
                $input = $this->processUploads($input, $folder, $name, $type);
                $this->removeFileExits($name);
            } else {
                unset($input[$name]);
            }
        }
        return $input;
    }

    private function multi($input, $name, $folder, $type)
    {
        if (isset($this->pathUpload)) {
            $folder = $this->pathUpload[$name];
        }
        $link = $this->generatePath($folder, $type);
        $thumb = isset($this->thumbImage[$name]) ? $this->thumbImage[$name] : [];
        foreach ($input[$name] as $index => $value) {
            if (is_file($input[$name][$index])) {

                if ($type === 0) {
                    $input[$name][$index] = UploadFa::file($input[$name][$index], $link);
                } else {
                    $input[$name][$index] = UploadFa::images(
                        $input[$name][$index],
                        $link,
                        $thumb
                    );
                }
            } else {
                unset($input[$name]);
            }
        }
        return $input;
    }

    private function uploadJson($input, $name, $folder, $type)
    {
        if (isset($this->pathUpload)) {
            $folder = $this->pathUpload[$name];
        }
        $link = $this->generatePath($folder, $type);
        $thumb = isset($this->thumbImage[$name]) ? $this->thumbImage[$name] : [];

        foreach ($input[$name] as $index => $value) {
            if (is_file($input[$name][$index])) {
                if ($type === 0) {
                    $input[$name][$index] = UploadFa::file($input[$name][$index], $link);
                } else {
                    $input[$name][$index] = UploadFa::images(
                        $input[$name][$index],
                        $link,
                        $thumb
                    );
                }
            } else {
                unset($input[$name]);
            }
        }

        return $input;
    }

    private function processUploads($input, $folder, $name, $key)
    {
        if (isset($this->pathUpload)) {
            $folder = $this->pathUpload[$name];
        }

        $link = $this->generatePath($folder);

        if ($key === 0) {
            $input[$name] = UploadFa::file($input[$name], $link);
        } else {
            $input[$name] = UploadFa::images(
                $input[$name],
                $link,
                isset($this->thumbImage[$name]) ? $this->thumbImage[$name] : []
            );
        }

        return $input;
    }

    private function generatePath($folder)
    {
        $basePath = config('filesystems.disks.public.root');

        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $basePath = $basePath . $folder;
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $basePath = $basePath . '/' . date('Y');
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $basePath = $basePath . '/' . date('m');
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $basePath = $basePath . '/' . date('d');
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        return $basePath;
    }

    private function removeFileExits($name)
    {
        $basePath = config('filesystems.disks.public.root');
        $names = explode('/', $this->$name);
        if (isset($this->$name) && $this->$name != '') {
            try {
                Log::debug($basePath . ($this->$name) );
                unlink($basePath . ($this->$name) );
            } catch (\Exception $e) {
                event(new LogUploadEvent($e, "FILE"));
            }
        }

        $files = array_pop($names);
        $fileName = explode('.', $files)[0];

        if (isset($this->thumbImage[$name]) && isset($fileName)) {
            foreach (glob($basePath . implode('/', $names) . '*') as $folder) {
                $this->scanFile($folder, $fileName);
            }
        }
    }

    private function scanFile($dir, $fileName)
    {
        if (is_dir($dir)) {
            foreach (glob($dir . '/*') as $file) {
                try {
                    if (is_file($file)) {
                        if (strpos($file, $fileName) !== false) {
                            Log::debug($file );
                            unlink($file);
                        }
                    } else {
                        $this->scanFile($file, $fileName);
                    }
                } catch (\Exception $exception) {

                }

            }
        } else {
            if (strpos($dir . '', $fileName) !== false) {
                unlink($dir . '');
            }
        }
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
        if (isset($input[NULL_FILTER])) {
            foreach ($input[NULL_FILTER] as $value) {
                $query->whereNull($this->table . '.' . $value);
            }
        }
        if (isset($input[NOT_NULL_FILTER])) {
            foreach ($input[NOT_NULL_FILTER] as $value) {
                $query->whereNotNull($this->table . '.' . $value);
            }
        }
        return $query;
    }

    public function getImage($img)
    {
        return asset("storage{$img}");
    }

    public function getThumbPath($img, $sizes)
    {
        $sizeImage = '_' . implode('_', $sizes) . '.';
        $img = str_replace('.', $sizeImage, $img);
        return $this->getImage($img);
    }
}