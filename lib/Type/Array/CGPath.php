<?php

namespace Type\Array;

class CGPath implements CGPathInterface
{

    protected string $String;
    protected array $array;

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    public function getPath($Path, $Default)
    {
        $r = $this->array_get_value($this->array, $Path);
        return $r ?? $Default;
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param string $glue
     * @return mixed
     */
    private function array_get_value(array &$array, array|string $parents, string $glue = '.'): mixed
    {
        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $ref = &$array;

        foreach ((array)$parents as $parent) {
            if (is_array($ref) && array_key_exists($parent, $ref)) {
                $ref = &$ref[$parent];
            } else {
                return null;
            }
        }
        return $ref;
    }

    public function setPath($Path, $Value)
    {
        $this->array_set_value($this->array, $Path, $Value);
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param mixed $value
     * @param string $glue
     */
    private function array_set_value(array &$array, $parents, $value, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, (string)$parents);
        }

        $ref = &$array;

        foreach ($parents as $parent) {
            if (isset($ref) && !is_array($ref)) {
                $ref = array();
            }

            $ref = &$ref[$parent];
        }

        $ref = $value;
    }

    public function delPath($Path)
    {
        $this->array_unset_value($this->array, $Path);
    }

    /**
     * @param array $array
     * @param array|string $parents
     * @param string $glue
     */
    private function array_unset_value(&$array, $parents, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $key = array_shift($parents);

        if (empty($parents)) {
            unset($array[$key]);
        } else {
            $this->array_unset_value($array[$key], $parents);
        }
    }
}