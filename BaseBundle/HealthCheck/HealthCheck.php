<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Class HealthCheck
 */
class HealthCheck
{
    protected $tests = array();
    protected $healthCheckResultClass;

    /**
     * @param $healthCheckResultClass
     */
    public function __construct($healthCheckResultClass)
    {
        $this->healthCheckResultClass = $healthCheckResultClass;
    }

    /**
     * @param HealthCheckTestInterface $test
     */
    public function addTest(HealthCheckTestInterface $test)
    {
        $this->tests[] = $test;
    }

    /**
     * @return HealthCheckResult
     */
    public function run()
    {
        /** @var HealthCheckResult $healthCheckResult */
        $healthCheckResult = new $this->healthCheckResultClass();

        /** @var HealthCheckTestInterface $test */
        foreach ($this->tests as $test) {
            $healthCheckResult->addResult($test->run());
        }

        return $healthCheckResult;
    }
}