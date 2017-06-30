<?php

namespace OpenOrchestra\BaseBundle\Tests\HealthCheck;

use OpenOrchestra\BaseBundle\HealthCheck\HealthCheckResult;
use OpenOrchestra\BaseBundle\HealthCheck\HealthCheckTestResultInterface;
use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use Phake;

/**
 * Class HealthCheckResultTest
 */
class HealthCheckResultTest extends AbstractBaseTestCase
{
    /** @var  HealthCheckResult */
    protected $healthCheckResult;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->healthCheckResult = new HealthCheckResult();
    }

    /**
     * @param array $resultsTest
     * @param int   $level
     * @param bool  $expected
     *
     * @dataProvider provideResultTest
     */
    public function testIsSuccess(array $resultsTest, $level, $expected)
    {
        foreach ($resultsTest as $resultTest) {
            $this->healthCheckResult->addResult($resultTest);
        }

        $this->assertEquals($expected, $this->healthCheckResult->isSuccess($level));

    }

    /**
     * @return array
     */
    public function provideResultTest()
    {
        $resultTestErrorWarning = Phake::mock(HealthCheckTestResultInterface::class);
        Phake::when($resultTestErrorWarning)->isError()->thenReturn(true);
        Phake::when($resultTestErrorWarning)->getLevel()->thenReturn(HealthCheckTestResultInterface::WARNING);

        $resultTestError = Phake::mock(HealthCheckTestResultInterface::class);
        Phake::when($resultTestError)->isError()->thenReturn(true);
        Phake::when($resultTestError)->getLevel()->thenReturn(HealthCheckTestResultInterface::ERROR);

        $resultTestValid = Phake::mock(HealthCheckTestResultInterface::class);
        Phake::when($resultTestValid)->isError()->thenReturn(false);

        return array(
            array(array($resultTestValid, $resultTestValid), HealthCheckTestResultInterface::ERROR, true),
            array(array($resultTestValid, $resultTestError), HealthCheckTestResultInterface::ERROR, false),
            array(array($resultTestValid, $resultTestErrorWarning), HealthCheckTestResultInterface::ERROR, true),
            array(array($resultTestValid, $resultTestErrorWarning), HealthCheckTestResultInterface::WARNING, false),
            array(array($resultTestValid, $resultTestError), HealthCheckTestResultInterface::WARNING, false),
        );
    }
}
