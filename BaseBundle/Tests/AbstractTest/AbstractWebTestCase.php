<?php

namespace OpenOrchestra\BaseBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractWebTestCase
 */
class AbstractWebTestCase extends WebTestCase
{
    use TestCleanUpTearDownTrait;
}