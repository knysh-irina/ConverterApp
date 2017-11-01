<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SoapBox\Formatter\Formatter;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic functional test for JSON to Array conversion
     *
     * @return void
     */
    public function testJsonToArray() {
        $data = '{"foo":"bar","bar":"foo"}';
        $actual = Formatter::make($data, Formatter::JSON)->toArray();
        $expected = ['foo'=>'bar', 'bar'=>'foo'];
        $this->assertEquals($expected, $actual);
    }
    /**
     * A basic functional test for Array to JSON conversion
     *
     * @return void
     */
    public function testArrayToJson() {
        $data = ['foo'=>'bar', 'bar'=>'foo'];
        $actual = Formatter::make($data, Formatter::ARR)->toJson();
        $expected = '{"foo":"bar","bar":"foo"}';
        $this->assertEquals($expected, $actual);
    }
    /**
     * A basic functional test for CSV data to array
     *
     * @return void
     */
    public function testCSVToArray() {
        $data = 'foo,bar,bing,bam,boom';
        $actual = Formatter::make($data, Formatter::CSV)->toArray();
        $expected = array('foo','bar','bing','bam','boom');
        $this->assertEquals($expected, $actual);
    }
    /**
     * A basic functional test for testJSONToXMLToArrayToJsonToArray data to array
     *
     * @return void
     */
    public function testJSONToXMLToArrayToJsonToArray() {
        $data = '{"foo":"bar","bar":"foo"}';
        $result = Formatter::make($data, Formatter::JSON)->toXml();
        $result = Formatter::make($result, Formatter::XML)->toArray();
        $result = Formatter::make($result, Formatter::ARR)->toJson();
        $actual = Formatter::make($result, Formatter::JSON)->toArray();
        $expected = ['foo'=>'bar', 'bar'=>'foo'];
        $this->assertEquals($expected, $actual);
    }
}
