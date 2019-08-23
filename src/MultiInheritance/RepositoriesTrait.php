<?php
/**
 * Created by cuongpm/modularization.
 * User: e
 * Date: 1/7/17
 * Time: 1:40 PM
 */

namespace Modularization\MultiInheritance;


use Illuminate\Support\Facades\DB;


/**
 * Trait RepositoriesTrait
 * @package Modularization\MultiInheritance
 */
trait RepositoriesTrait
{
    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterList($filter = [], $field = 'name')
    {
        return $this->makeModel()
            ->filter($filter)
            ->pluck($field, 'id');
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterListOrder($filter = [], $field = 'name')
    {
        return $this->makeModel()
            ->filter($filter)
            ->orderBy($field)
            ->pluck($field, 'id');
    }

    /**
     * @param $id
     * @param int $skip
     * @return bool
     */
    public function destroyGetData($id, $skip = 0)
    {
        $result = $this->delete($id);

        if ($result) {
            if ($skip !== 0) {
                $data = $this->makeModel()
                    ->skip($skip)
                    ->take(1)
                    ->orderBy('id', 'DESC')
                    ->get();
                if (count($data) === 1) {
                    return $data[0];
                }
            }
            return $result;
        }

        return false;
    }

    /**
     * @param $path
     */
    public function importing($path)
    {
        Excel::load($path, function ($reader) use ($path) {
            $results = $reader->toArray();
            foreach ($results as $value) {
                $this->create($value);
            }
        });

        unlink($path);
    }

    /**
     * @param array $filter
     * @param array $select
     * @return mixed
     */
    public function filterGet($filter = [], $select = ['*'])
    {
        return $this->makeModel()
            ->filter($filter)
            ->get($select);
    }

    /**
     * @param array $filter
     * @param array $select
     * @param int $limit
     * @return mixed
     */
    public function filterLimit($filter = [], $select = ['*'], $limit = 1000)
    {
        return $this->makeModel()
            ->filter($filter)
            ->limit($limit)
            ->get($select);
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterCount($filter = [], $field = 'id')
    {
        return $this->makeModel()
            ->filter($filter)
            ->count($field);
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterSum($filter = [], $field = 'id')
    {
        return $this->makeModel()
            ->filter($filter)
            ->sum($field);
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterAvg($filter = [], $field = 'id')
    {
        return $this->makeModel()
            ->filter($filter)
            ->avg($field);
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterFirst($filter = [])
    {
        return $this->makeModel()
            ->filter($filter)
            ->first();
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterLookFirst($filter = [])
    {
        return $this->makeModel()
            ->filter($filter)
            ->lockForUpdate()
            ->first();
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterOneList($filter = [], $field = 'id')
    {
        return $this->makeModel()
            ->filter($filter)
            ->orderBy($field)
            ->pluck($field);
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterDelete($filter = [])
    {
        return $this->makeModel()
            ->filter($filter)
            ->delete();
    }

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterValue($filter = [], $field = 'id')
    {
        return $this->makeModel()
            ->filter($filter)
            ->value($field);
    }

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statistic($column, $filter = [])
    {
        return $this->makeModel()
            ->select($column, DB::raw('COUNT(*) as count'))
            ->filter($filter)
            ->groupBy($column)
            ->select($column, 'count')
            ->get();
    }

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statisticList($column, $filter = [])
    {
        return $this->makeModel()
            ->select($column, DB::raw('COUNT(*) as count'))
            ->filter($filter)
            ->groupBy($column)
            ->pluck('count', $column);
    }

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statisticListArray($column, $filter = [])
    {
        return $this->statisticList($filter, $column)->toArray();
    }
}