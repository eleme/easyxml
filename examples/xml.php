<?php
require __DIR__.'/../vendor/autoload.php';

$array = array('abc' => array('cba' => 'abc', 'abc' => ''));
echo array_2_xml($array), "\n";
$structure = '<?xml version="1.0" encoding="utf-8"?>';
echo array_2_xml($array, $structure), "\n";

$json = '{"abc":{"cba":"abc","abc":""}}';
echo json_2_xml($json), "\n";
$structure = '<?xml version="1.0" encoding="utf-8"?>';
echo json_2_xml($json, $structure), "\n";

$xml = '<?xml version="1.0"?><abc><cba>abc</cba><abc/></abc>';
echo var_export(xml_2_array($xml)), "\n";
echo xml_2_json($xml), "\n";
