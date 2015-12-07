<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 23/11/2015
 * Time: 12:29
 */

namespace Model;


interface ArrayConvertion
{
    public function toArray();

    public function fromArray(array $data);
}