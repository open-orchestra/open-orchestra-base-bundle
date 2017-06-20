<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Class AbstractHealthCheckTest
 */
abstract class AbstractHealthCheckTest implements HealthCheckTestInterface
{
    protected $healthCheckResultClass;

    /**
     * @param string $healthCheckResultClass
     */
    public function setHealthCheckResultClass($healthCheckResultClass)
    {
        $this->healthCheckResultClass = $healthCheckResultClass;
    }

    /**
     * @param bool   $error
     * @param string $label
     * @param int    $level
     *
     * @return HealthCheckTestResultInterface
     */
    protected function createTestResult($error, $label, $level = HealthCheckTestResultInterface::OK)
    {
        return new $this->healthCheckResultClass($error, $label, $level);
    }

    /**
     * @param string $label
     *
     * @return HealthCheckTestResultInterface
     */
    protected function createValidTestResult($label)
    {
        return new $this->healthCheckResultClass(false, $label, HealthCheckTestResultInterface::OK);
    }
}