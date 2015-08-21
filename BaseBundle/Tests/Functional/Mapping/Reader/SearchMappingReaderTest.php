<?php

namespace OpenOrchestra\BaseBundle\Tests\Functional\Mapping\Reader;

use OpenOrchestra\Mapping\Annotations as ORCHESTRA;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class SearchMappingReaderTest
 */
class SearchMappingReaderTest extends KernelTestCase
{
    protected $readerSearch;
    protected $fakeClass;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->fakeClass = new FakeClassAnnotation();

        static::bootKernel();
        $this->readerSearch = static::$kernel->getContainer()->get('open_orchestra_base.annotation_search_reader');
    }

    /**
     * Test ExtractMapping
     */
    public function testExtractMapping()
    {
        $mappingProperties = array(
            "fake_property1" =>array(
                "key" => "fake_property1",
                "field" => "fakeProperty1",
                "type" => "fakeType",
            ),
            "fake_property2" =>array(
                "key" => "fake_property2",
                "field" => "fakeProperty2",
                "type" => "string",
            ),
            "fake_property_multi" =>array(
                "key" => "fake_property_multi",
                "field" => "fakePropery.embeded",
                "type" => "string",
            )
        );

        $mapping = $this->readerSearch->extractMapping($this->fakeClass);
        $this->assertCount(3, $mapping);
        foreach($mapping as $property => $searchAnnotation) {
            $this->assertInstanceOf('OpenOrchestra\Mapping\Annotations\Search', $searchAnnotation);
            foreach($mappingProperties[$property] as $key => $value ) {
                $this->assertSame($value, $searchAnnotation->{'get'.$key}());
            }
        }
    }
}

/**
 * Class FakeClassAnnotation
 */
class FakeClassAnnotation
{
    /**
     * @ORCHESTRA\Search(
     *      type="fakeType",
     *      key="fake_property1",
     *      field="fakeProperty1"
     * )
     */
    protected $fakeProperty1;

    /**
     * @ORCHESTRA\Search(key="fake_property2")
     * @ORCHESTRA\Search(key="fake_property_multi", field="fakePropery.embeded")
     */
    protected $fakeProperty2;
}
