<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 3/22/18
 * Time: 11:14 AM
 */

namespace Modularization\MultiInheritance;


interface ExtraRepositoryInterface
{
    public function data($input = []);

    public function filterCount($input = []);

    public function filterFirst($input = []);

    public function filterList($input = [], $field = 'name');

    public function filterOneList($input = [], $field = 'id');

    public function getList($input = []);

    public function importing($path);

    public function filterValue($input = [], $column = '*');

    public function statistic($column, $input = []);

    public function statisticList($column, $input = []);

    public function statisticListArray($column, $input = []);

    public function tags($tagNames, $data);
}