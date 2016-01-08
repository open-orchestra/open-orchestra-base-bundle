<?php

namespace OpenOrchestra\BaseBundle\Tests\AbstractTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class AbstractKernelTestCase
 */
class AbstractKernelTestCase extends KernelTestCase
{
    use TestCleanUpTearDownTrait;
}
