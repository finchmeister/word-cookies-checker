<?php


class Permute
{

    protected $permutes;
    protected $allPermutes = [];
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
        $this->pc_permute($items);
        $this->permutes = array_unique($this->permutes);
        sort($this->permutes);
    }

    public function pc_permute($items, $perms = array( )) {
        if (empty($items)) {
            $this->permutes[] = join('', $perms);
        }  else {
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->pc_permute($newitems, $newperms);
            }
        }
    }

    public function getAllPermutes()
    {
        $length = count($this->items);
        $noOfPermutes = count($this->permutes);
        for ($i = 2; $i <= $length; $i++) {
            $substr = function($string, $i) {
                return substr($string, 0, $i);
            };
            $this->allPermutes[$i] = array_map(
                $substr,
                $this->permutes,
                array_fill(0, $noOfPermutes, $i)
            );
        }
        $this->allPermutes = array_map('array_unique', $this->allPermutes);
        return $this->allPermutes;
    }

    public function getTotalCount()
    {
        return array_sum(array_map('count', $this->allPermutes));

    }

    public function getPermutes()
    {
        return $this->permutes;
    }

}