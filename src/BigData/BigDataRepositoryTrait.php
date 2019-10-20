<?php


trait BigDataRepositoryTrait
{
    public function count($filter, $field, $option, $number)
    {
        if ($this->isOptimal($option)) {
            return $this->makeModel()
                ->selectRaw("COUNT(*) from {$this->table}) - count(*) as number")
                ->where($field, $this->changeOption($option), $number)
                ->value('number');
        }

        return $this->makeModel()
            ->filter($filter)
            ->where($field, $option, $number)
            ->count();
    }

    public function isOptimal($number)
    {
        return $number < 1000;
    }

    public function changeOption($option)
    {
        return $option;
    }

    public function update($filter, $on, $data)
    {
        $table = $this->table;

        return $this->makeModel()
            ->join("{$table} as t1", function ($join) use ($filter, $on) {
                $join->filterJoin($join, $filter, $on);
            })->update($data);
    }

    public function filterJoin($join, $filter, $on)
    {
        $join->on($on)->filter($filter);
    }
}
