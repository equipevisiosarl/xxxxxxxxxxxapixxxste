<?php

function insert_table(array|object $table, array $data)
{
    $data = (array)$data;
    foreach ($data as $key => $value) {
        $table[$key] = $value;
    }
    return $table;
}

function unset_data(array|object $data, array $unsetData)
{
    $datas = (array)$data;
    foreach ($unsetData as $value) {
        if (isset($datas[$value])) {
           unset($datas[$value]);
         }
    }
    return $datas;
}

function map_data(array|object $data, array $arrayMap) 
{
    $data = (array)$data;
    $datas = array();
    foreach ($arrayMap as $key => $value) :
        $key = (is_numeric($key)) ? $value : $key;
        if (isset($data[$value])) {
           $datas[$key] = $data[$value];
        }
    endforeach;

    return $datas;
}


