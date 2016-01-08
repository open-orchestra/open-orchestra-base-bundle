<?php

namespace OpenOrchestra\BaseBundle\Tests\AbstractTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractWebTestCase
 */
abstract class  AbstractWebTestCase extends WebTestCase
{
    use TestCleanUpTearDownTrait;
}
