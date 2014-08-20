<?php
namespace Eleme\EasyXml;

use SimpleXmlElement;
use JsonSerializable;

class Xml implements JsonSerializable
{
    private $xml = null;

    public function __construct(SimpleXmlElement $xml)
    {
        $this->xml = $xml;
    }

    public static function fromArray(array $array, $structure = '')
    {
        $xml = $structure;
        $xml .= array_2_xml($array);
        return new self(new SimpleXMLElement($xml));
    }

    public static function fromJson($json, $structure = '')
    {
        return self::fromArray(json_decode($json, true), $structure);
    }

    public static function fromXml($xml)
    {
        return new self(new SimpleXMLElement($xml, LIBXML_NOCDATA));
    }

    public function toArray()
    {
        return array($this->xml->getName() => xml_object_2_array($this->xml));
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toXml()
    {
        return $this->xml->asXml();
    }

    public function __toString()
    {
        return $this->toXml();
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

function xml_object_2_array($object)
{
    $array = (array) $object;
    foreach ($array as $key => $value) {
        if ($value instanceof SimpleXmlElement) {
            if ($value->count()) {
                $array[$key] = xml_object_2_array($value);
            } else {
                $array[$key] = "";
            }
        } elseif (is_array($value)) {
            $array[$key] = xml_object_2_array($value);
        } else {
            $array[$key] = $value;
        }
    }
    return $array;
}

function is_index_array(array $array)
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

function array_2_xml(array $array, $tag = '')
{
    $string = '';
    if (is_index_array($array)) {
        foreach ($array as $value) {
            $string .= value_2_xml($value, $tag);
        }
    } else {
        foreach ($array as $key => $value) {
            $string .= value_2_xml($value, $key);
        }
        if ($tag) {
            $string = "<{$tag}>{$string}</{$tag}>";
        }
    }
    return $string;
}

function value_2_xml($value, $tag)
{
    if (is_array($value)) {
        return array_2_xml($value, $tag);
    } elseif ($value === '') {
        return "<{$tag}/>";
    } else {
        return "<{$tag}>{$value}</{$tag}>";
    }
}
