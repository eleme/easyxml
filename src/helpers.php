<?php

function _xml_object_2_array($object)
{
    $array = (array) $object;
    foreach ($array as $key => $value) {
        if ($value instanceof SimpleXmlElement) {
            if ($value->count()) {
                $array[$key] = _xml_object_2_array($value);
            } else {
                $array[$key] = "";
            }
        } elseif (is_array($value)) {
            $array[$key] = _xml_object_2_array($value);
        } else {
            $array[$key] = $value;
        }
    }
    return $array;
}

function _is_index_array(array $array)
{
    $id = 0;
    foreach ($array as $key => $value) {
        if ($key !== $id) {
            return false;
        }
        $id++;
    }
    return true;
}

function _value_2_xml($value, $tag)
{
    if (is_array($value)) {
        return _array_2_xml($value, $tag);
    } elseif ($value === '') {
        return "<{$tag}/>";
    } else {
        return "<{$tag}>{$value}</{$tag}>";
    }
}

function _array_2_xml(array $array, $tag = '')
{
    $string = '';
    if (_is_index_array($array)) {
        foreach ($array as $value) {
            $string .= _value_2_xml($value, $tag);
        }
    } else {
        foreach ($array as $key => $value) {
            $string .= _value_2_xml($value, $key);
        }
        if ($tag) {
            $string = "<{$tag}>{$string}</{$tag}>";
        }
    }
    return $string;
}

if (!function_exists('array_2_xml')) {
    function array_2_xml(array $array, $structure = '<?xml version="1.0"?>')
    {
        return $structure._array_2_xml($array);
    }
}

if (!function_exists('json_2_xml')) {
    function json_2_xml($json, $structure = '<?xml version="1.0"?>')
    {
        return $structure._array_2_xml(json_decode($json, true));
    }
}

if (!function_exists('xml_2_array')) {
    function xml_2_array($xml)
    {
        $xml = new SimpleXMLElement($xml, LIBXML_NOCDATA);
        return array($xml->getName() => _xml_object_2_array($xml));
    }
}

if (!function_exists('xml_2_json')) {
    function xml_2_json($xml)
    {
        $xml = new SimpleXMLElement($xml, LIBXML_NOCDATA);
        return json_encode(array($xml->getName() => _xml_object_2_array($xml)));
    }
}
