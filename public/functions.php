<?php

function insert_table(array|object $table, array $data)
{
    $data = (array)$data;
    foreach ($data as $key => $value) {
        $table[$key] = $value;
    }
    return $table;
}

function unset_data(array $data, array $unsetData)
{
    $datas = (array)$data;
    foreach ($unsetData as $value) {
        if (isset($datas[$value])) {
           unset($datas[$value]);
         }
    }
    return $datas;
}

function unset_obj_data(object $data, array $unsetData)
{ $datas = $data;
    foreach ($unsetData as $value) {
        if (isset($datas->$value)) {
           unset($datas->$value);
         }
    }
    return $datas;
}

function reverse_unset_obj_data(object $data, array $noUnsetData)
{ $datas = new stdClass();
    foreach ($noUnsetData as $value) {
        if (isset($data->$value)) {
           $datas->$value = $data->$value;
         }
    }
    return $datas;
}

function object_items_null(array $array)
{ $datas = new stdClass();
    foreach ($array as $value) {
        
           $datas->$value = null;
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

function map_data_rule(array|object $data, array $arrayMap)
{
    $data = (array)$data;
    $rules = array();
    foreach ($data as $key => $value) {
       if (isset($arrayMap[$key])) {
       $rules[$key] = $arrayMap[$key];
       }
    }
    return $rules;
}

function removeAccents($string) {
    $accents = [
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
        'à' => 'a', 'â' => 'a', 'ä' => 'a',
        'ô' => 'o', 'ö' => 'o', 'ò' => 'o',
        'ù' => 'u', 'û' => 'u', 'ü' => 'u',
        'ç' => 'c', 'î' => 'i', 'ï' => 'i',
        'ñ' => 'n'
    ];

    return strtr($string, $accents);
}



