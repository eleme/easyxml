<?php
namespace Eleme\EasyXml\Tests;

use Eleme\EasyXml\Xml;
use PHPUnit_Framework_TestCase;

class XmlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider arrayWithXml
     */
    public function testArrayToXml(array $data, $string)
    {
        $xml = Xml::fromArray($data);
        $this->assertEquals($string, $xml->toXml());
        $this->assertEquals($string, (string)$xml);
        $this->assertEquals($string, array_2_xml($data));
    }

    /**
     * @dataProvider arrayWithXml
     */
    public function testXmlToArray(array $data, $string)
    {
        $xml = Xml::fromXml($string);
        $this->assertEquals($data, $xml->toArray());
        $this->assertEquals($data, xml_2_array($string));
    }

    /**
     * @dataProvider jsonWithXml
     */
    public function testJsonToXml($json, $string)
    {
        $xml = Xml::fromJson($json);
        $this->assertEquals($string, $xml->toXml());
        $this->assertEquals($string, json_2_xml($json));
    }

    /**
     * @dataProvider jsonWithXml
     */
    public function testXmlToJson($json, $string)
    {
        $xml = Xml::fromXml($string);
        $this->assertEquals($json, $xml->toJson());
        $this->assertEquals($json, xml_2_json($string));
    }

    public function testStructure()
    {
        $data = array('foo' => array('bar' => array('a' => 'b', 'c' => 'd')));
        $structure = '<?xml version="1.0" encoding="utf-8"?>';
        $string = '<?xml version="1.0" encoding="utf-8"?>'."\n".'<foo><bar><a>b</a><c>d</c></bar></foo>'."\n";
        $this->assertEquals($string, Xml::fromArray($data, $structure)->toXml());
        $this->assertEquals($string, array_2_xml($data, $structure));
    }

    public function arrayWithXml()
    {
        return array(
            array(array('foo' => array('bar' => array('a' => 'b', 'c' => 'd'))),
                '<?xml version="1.0"?>'."\n".'<foo><bar><a>b</a><c>d</c></bar></foo>'."\n"
            ),
            array(array('abc' => array('cba' => 'abc', 'abc' => '')),
                '<?xml version="1.0"?>'."\n".'<abc><cba>abc</cba><abc/></abc>'."\n"
            ),
            array(array('abc' => array('cba' => 'abc', 'ss' => array('s' => array('n', 'n')))),
                '<?xml version="1.0"?>'."\n".'<abc><cba>abc</cba><ss><s>n</s><s>n</s></ss></abc>'."\n"
            )
        );
    }

    public function jsonWithXml()
    {
        return array(
            array('{"foo":{"bar":{"a":"b","c":"d"}}}',
                '<?xml version="1.0"?>'."\n".'<foo><bar><a>b</a><c>d</c></bar></foo>'."\n"
            ),
            array('{"abc":{"cba":"abc","abc":"abc"}}',
                '<?xml version="1.0"?>'."\n".'<abc><cba>abc</cba><abc>abc</abc></abc>'."\n"
            )
        );
    }
}
