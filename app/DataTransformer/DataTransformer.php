<?php

/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 17/11/2016
 * Time: 9:26 SA
 */
abstract class DataTransformer
{
    public function transformerCollection($items, $method = 'transform'){
        return array_map([$this, $method], $items);
    }

    public abstract function transform($item);
}