<?php

namespace OpenOrchestra\BaseBundle\Tests\AbstractTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractWebTestCase
 */
class AbstractWebTestCase extends WebTestCase
{
    use TestCleanUpTearDownTrait;
}