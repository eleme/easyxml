<?php

class XmlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider arrayWithXml
     */
    public function testArrayToXml(array $data, $string)
    {
        $this->assertEquals($string, array_2_xml($data));
    }

    /**
     * @dataProvider arrayWithXml
     */
    public function testXmlToArray(array $data, $string)
    {
        $this->assertEquals($data, xml_2_array($string));
    }

    /**
     * @dataProvider jsonWithXml
     */
    public function testJsonToXml($json, $string)
    {
        $this->assertEquals($string, json_2_xml($json));
    }

    /**
     * @dataProvider jsonWithXml
     */
    public function testXmlToJson($json, $string)
    {
        $this->assertEquals($json, xml_2_json($string));
    }

    public function testStructure()
    {
        $data = array('foo' => array('bar' => array('a' => 'b', 'c' => 'd')));
        $structure = '<?xml version="1.0" encoding="utf-8"?>';
        $string = '<?xml version="1.0" encoding="utf-8"?><foo><bar><a>b</a><c>d</c></bar></foo>';
        $this->assertEquals($string, array_2_xml($data, $structure));
    }

    public function arrayWithXml()
    {
        return array(
            array(array('foo' => array('bar' => array('a' => 'b', 'c' => 'd'))),
                '<?xml version="1.0"?><foo><bar><a>b</a><c>d</c></bar></foo>'
            ),
            array(array('abc' => array('cba' => 'abc', 'abc' => '')),
                '<?xml version="1.0"?><abc><cba>abc</cba><abc/></abc>'
            ),
            array(array('abc' => array('cba' => 'abc', 'ss' => array('s' => array('n', 'n')))),
                '<?xml version="1.0"?><abc><cba>abc</cba><ss><s>n</s><s>n</s></ss></abc>'
            )
        );
    }

    public function jsonWithXml()
    {
        return array(
            array('{"foo":{"bar":{"a":"b","c":"d"}}}',
                '<?xml version="1.0"?><foo><bar><a>b</a><c>d</c></bar></foo>'
            ),
            array('{"abc":{"cba":"abc","abc":"abc"}}',
                '<?xml version="1.0"?><abc><cba>abc</cba><abc>abc</abc></abc>'
            )
        );
    }
}
