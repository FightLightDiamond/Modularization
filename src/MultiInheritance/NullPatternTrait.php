<?php


namespace Cuongpm\Modularization\MultiInheritance;


trait NullPatternTrait
{
    public $__value__;

    function __call($name, $arguments)
    {
        if (is_object($this->__value__) && method_exists($this->__value__, $name))
            return new NullObject(call_user_func_array(array($this->__value__, $name), $arguments));
        else
            return new NullObject();
    }

    function __get($name)
    {
        if (is_object($this->__value__) && property_exists($this->__value__, $name))
            return new NullObject($this->__value__->$name);
        else
            return new NullObject();
    }

    function __set($name, $value)
    {
        if (is_object($this->__value__)) $this->__value__->$name = $value;
    }

    function __isset($name)
    {
        return is_object($this->__value__) && property_exists($this->__value__, $name);
    }

    function __unset($name)
    {
        if (is_object($this->__value__)) unset($this->__value__->$name);
    }

    function __toString()
    {
        if (is_array($this->__value__))
            return implode(', ', $this->__value__);
        else
            return (string)$this->__value__;
    }

    function present()
    {
        return !empty($this->__value__);
    }

    function or_default($default)
    {
        if ($this->present()) {
            return $this->__value__;
        } else {
            return $default;
        }
    }

    function __invoke($key)
    {
        if (!is_array($this->__value__)) return new NullObject();
        if (func_num_args() > 1) $this->__value__[$key] = func_get_arg(1);
        if (array_key_exists($key, $this->__value__))
            return new NullObject($this->__value__[$key]);
        else
            return new NullObject();
    }
}

class NullObject
{
    use NullPattern;

    function __construct($value = null)
    {
        if ($value) {
            if (is_assoc($value)) $value = (object)$value;
            $this->__value__ = $value;
        }
    }
}

if (!function_exists('is_assoc')) {
    function is_assoc($v)
    {
        return is_array($v) && array_diff_key($v, array_keys(array_keys($v)));
    }
}
