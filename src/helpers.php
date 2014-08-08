<?php

if (!function_exists('array_2_xml')) {
    function array_2_xml(array $array, $structure = '')
    {
        return Eleme\EasyXml\Xml::fromArray($array, $structure)->toXml();
    }
}

if (!function_exists('json_2_xml')) {
    function json_2_xml($json, $structure = '')
    {
        return Eleme\EasyXml\Xml::fromJson($json, $structure)->toXml();
    }
}

if (!function_exists('xml_2_array')) {
    function xml_2_array($xml)
    {
        return Eleme\EasyXml\Xml::fromXml($xml)->toArray();
    }
}

if (!function_exists('xml_2_json')) {
    function xml_2_json($xml)
    {
        return Eleme\EasyXml\Xml::fromXml($xml)->toJson();
    }
}
