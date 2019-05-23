<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 8/23/2016
 * Time: 4:08 PM
 */

namespace Modularization\Facades;

use Carbon\Carbon;

class InputFun
{
    public function identify($repository)
    {
        $countIdentify = true;
        $identify = null;
        while ($countIdentify) {
            $identify = str_random(8);
            if ($repository->where('identify', $identify)->count() === 0) {
                $countIdentify = false;
            }
        }
        return $identify;
    }

    public function getIdentify($link)
    {
        $arrayString = explode("/", $link);
        $string = end($arrayString);
        return str_replace('.html', '', $string);
    }

    public function setSort($field)
    {
        $result = 'fa-sort';
        if (request()->get('order_by') == $field) {
            return $result = (request()->get('order') === 'ASC') ? 'fa-sort-asc' : 'fa-sort-desc';
        }
        return $result;
    }

    public function normalization($request)
    {
        $input = [];
        foreach ($request->all() as $k => $v) {
            if (is_string($v)) {
                $input[$k] = trim($v);
                if ($input[$k] === '') {
                    unset($input[$k]);
                }
            } elseif (is_array($v)) {
                $this->loopNormalization($input);
            }
        }
        return $input;
    }

    public function loopNormalization($input)
    {
        foreach ($input as $k => $v) {
            if (is_string($v)) {
                $input[$k] = trim($v);
                if ($input[$k] === '') {
                    unset($input[$k]);
                }
            } elseif (is_array($v)) {
                $this->loopNormalization($input);
            }
        }
    }

    public function buildRange($input, $field = 'datetime_range')
    {
        if (isset($input[$field])) {
            $dates = explode(' - ', $input[$field]);
            $input['from'] = Carbon::parse($dates[0])->format('Y-m-d') . ' 00:00:00';
            $input['to'] = Carbon::parse($dates[1])->format('Y-m-d') . ' 23:59:59';
            unset($input[$field]);
        } else {
            $input['from'] = date('Y-m-d') . ' 00:00:00';
            $input['to'] = date('Y-m-d') . ' 23:59:59';
        }
        return $input;
    }

    public function checkMonth($dateTimeRange, $month = 3)
    {
        $maxDayExport = (int)($month * 30 + round($month / 2));
        $dates = explode(' - ', $dateTimeRange);
        $dates[0] = Carbon::parse($dates[0])->format('Y-m-d');
        $dates[1] = Carbon::parse($dates[1])->format('Y-m-d');
        $input['from'] = $dates[0] . ' 00:00:00';
        $input['to'] = $dates[1] . ' 23:59:59';
        $diff = date_diff(date_create($input['from']), date_create($input['to']))->days;
        if ($diff > $maxDayExport) {
            return false;
        }
        $form = explode('-', $dates[0]);
        $to = explode('-', $dates[1]);
        if ($to[2] > $form[2] && ($to[1] - $form[1]) >= ($month - 1)) {
            return false;
        }
        return true;
    }
}