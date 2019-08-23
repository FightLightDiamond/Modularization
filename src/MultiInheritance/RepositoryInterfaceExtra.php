<?php
/**
 * Created by PhpStorm.
 * Date: 8/23/19
 * Time: 5:41 PM
 */

namespace Modularization\src\MultiInheritance;


/**
 * Interface RepositoryInterfaceTrait
 * @package Modularization\src\MultiInheritance
 */
interface RepositoryInterfaceExtra
{
    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterList($filter = [], $field = 'name');

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterListOrder($filter = [], $field = 'name');

    /**
     * @param $id
     * @param int $skip
     * @return mixed
     */
    public function destroyGetData($id, $skip = 0);

    /**
     * @param $path
     * @return mixed
     */
    public function importing($path);

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
    public function filterLimit($filter = [], $select = ['*'], $limit = 1000);

    /**
     * @param array $filter
     * @param string $field
     * @return mixed
     */
    public function filterCount($filter = [], $field = 'id');

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
     * @param string $field
     * @return mixed
     */
    public function filterOneList($filter = [], $field = 'id');

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
}