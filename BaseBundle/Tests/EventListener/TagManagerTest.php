<?php

namespace OpenOrchestra\BaseBundle\Tests\EventListener;

use OpenOrchestra\BaseBundle\Manager\TagManager;
use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;

/**
 * Test TagManagerTest
 */
class TagManagerTest extends AbstractBaseTestCase
{
    /**
     * @var TagManager
     */
    protected $manager;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->manager = new TagManager();
    }

    /**
     * @param string $methodName
     * @param string $prefix
     *
     * @dataProvider provideMethodAndPrefix
     */
    public function testFormat($methodName, $prefix)
    {
        $stringToTag = 'stringToTag';

        $this->assertSame($prefix . $stringToTag, $this->manager->$methodName($stringToTag));
    }

    /**
     * @return array
     */
    public function provideMethodAndPrefix()
    {
        return array(
            array('formatNodeIdTag', 'node-'),
            array('formatLanguageTag', 'language-'),
            array('formatSiteIdTag', 'site-'),
            array('formatBlockTypeTag', 'block-'),
            array('formatContentTypeTag', 'contentType-'),
            array('formatContentIdTag', 'contentId-'),
            array('formatMediaIdTag', 'mediaId-'),
            array('formatMenuTag', 'menu-'),
        );
    }
}
