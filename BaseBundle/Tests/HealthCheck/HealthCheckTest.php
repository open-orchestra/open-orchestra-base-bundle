<?php

namespace OpenOrchestra\BaseBundle\Tests\HealthCheck;

use OpenOrchestra\BaseBundle\HealthCheck\HealthCheck;
use OpenOrchestra\BaseBundle\HealthCheck\HealthCheckResult;
use OpenOrchestra\BaseBundle\HealthCheck\HealthCheckTestInterface;
use OpenOrchestra\BaseBundle\HealthCheck\HealthCheckTestResultInterface;
use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use Phake;

/**
 * Class HealthCheckTest
 */
class HealthCheckTest extends AbstractBaseTestCase
{
    /**
     * @var HealthCheck
     */
    protected $healthCheck;

    /**
     * Set up
     */
    public function setUp()
    {
        $healthCheckResultClass = HealthCheckResult::class;
        $this->healthCheck = new HealthCheck($healthCheckResultClass);
    }

    /**
     * test run
     */
    public function testRun()
    {
        $test = Phake::mock(HealthCheckTestInterface::class);
        Phake::when($test)->run()->thenReturn(Phake::mock(HealthCheckTestResultInterface::class));

        $this->healthCheck->addTest($test);

        $result = $this->healthCheck->run();
        Phake::verify($test)->run();
        $this->assertInstanceOf(HealthCheckResult::class, $result);
        $this->assertCount(1, $result->getResults());
    }
}
