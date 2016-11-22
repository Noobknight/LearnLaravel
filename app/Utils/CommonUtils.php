<?php

/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 18/11/2016
 * Time: 11:41 SA
 */
namespace App\Utils;
class CommonUtils
{
    public static function getResultLimitOffset($limit, $offset){
        $limit = $limit == null ? 10 : $limit;
        $offset = $offset == null ? 0 : $offset;
        return array('limit' => $limit, 'offset' => $offset);
    }
}