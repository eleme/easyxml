# Easyxml
[![Build Status](https://travis-ci.org/thbourlove/easyxml.png?branch=master)](https://travis-ci.org/thbourlove/easyxml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thbourlove/easyxml/badges/quality-score.png?s=f113f1ab965f6aaef55e497a330caf72bff94201)](https://scrutinizer-ci.com/g/thbourlove/easyxml/)
[![Code Coverage](https://scrutinizer-ci.com/g/thbourlove/easyxml/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thbourlove/easyxml/?branch=master)
[![Stable Status](https://poser.pugx.org/eleme/easyxml/v/stable.png)](https://packagist.org/packages/eleme/easyxml)

php xml lib.

## Install With Composer:

```json
"require": {
    "eleme/easyxml": "~0.3"
}
```

## Example

#### array_2_xml(array $array, $structure = '')
```php
$array = array('abc' => array('cba' => 'abc', 'abc' => ''));
echo array_2_xml($array), "\n";
$structure = '<?xml version="1.0" encoding="utf-8"?>';
echo array_2_xml($array, $structure), "\n";
```

#### json_2_xml($json, $structure = '')
```php
$json = '{"abc":{"cba":"abc","abc":""}}';
echo json_2_xml($json), "\n";
$structure = '<?xml version="1.0" encoding="utf-8"?>';
echo json_2_xml($json, $structure), "\n";
```

#### xml_2_array($xml)
```php
$xml = '<?xml version="1.0"?><abc><cba>abc</cba><abc/></abc>';
echo var_export(xml_2_array($xml)), "\n";
```

#### xml_2_json($xml)
```php
$xml = '<?xml version="1.0"?><abc><cba>abc</cba><abc/></abc>';
echo xml_2_json($xml), "\n";
```
