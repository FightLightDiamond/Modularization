<?php
/**
 * Created by PhpStorm.
 * Date: 8/23/19
 * Time: 5:41 PM
 */

namespace Cuongpm\Modularization\MultiInheritance;


/**
 * Interface RepositoryInterfaceTrait
 * @package Cuongpm\Modularization\MultiInheritance
 */
interface RepositoryInterfaceExtra
{
    /**
     * @param array $filter
     * @param string $field
     * @param boolean $distinct
     * @return mixed
     */
    public function filterOneList($filter = [], $field = 'id', $distinct = false);

    /**
     * @param array $filter
     * @param string $field
     * @param boolean $distinct
     * @return mixed
     */
    public function filterList($filter = [], $field = 'name', $distinct = false);

    /**
     * @param array $filter
     * @param string $field
     * @param boolean $distinct
     * @return mixed
     */
    public function filterListOrder($filter = [], $field = 'name', $distinct = false);

    /**
     * @param $id
     * @param int $skip
     * @return bool
     */
    public function destroyGetData($id, $skip = 0);

    /**
     * @param array $filter
     * @param array $select
     * @return mixed
     */
    public function filterGet($filter = [], $select = ['*']);

    /**
     * @param array $filter
     * @param array $select
     * @param int $limit
     * @return mixed
     */
    public function filterLimitGet($filter = [], $select = ['*'], $limit = 1000);

    /**
     * @param array $filter
     * @param array $select
     * @param int $perPage
     * @return mixed
     */
    public function filterPaginate($filter = [], $select = ['*'], $perPage = 1000);

    /**
     * @param array $filter
     * @param string $field
     * @param boolean $distinct
     * @return mixed
     */
    public function filterCount($filter = [], $field = 'id', $distinct = false);

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterSum($filter = [], $field = 'id');

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterAvg($filter = [], $field = 'id');

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterFirst($filter = []);

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterLookFirst($filter = []);

    /**
     * @param array $filter
     * @return mixed
     */
    public function filterDelete($filter = []);

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterValue($filter = [], $field = 'id');

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statistic($column, $filter = []);

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statisticList($column, $filter = []);

    /**
     * @param $column
     * @param array $filter
     * @return mixed
     */
    public function statisticListArray($column, $filter = []);

    /**
     * @param $filter
     * @param $input
     * @return mixed
     */
    public function rawUpdate($filter, $input);
}
