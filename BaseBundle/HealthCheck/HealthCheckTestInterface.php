<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Interface HealthCheckTestInterface
 */
interface HealthCheckTestInterface
{
    /**
     * @return HealthCheckTestResultInterface
     */
    public function run();

    /**
     * @param string $healthCheckResultClass
     */
    public function setHealthCheckResultClass($healthCheckResultClass);
}
