<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Interface HealthCheckResultInterface
 */
interface HealthCheckTestResultInterface
{
    const WARNING = 1;
    const ERROR = 2;
    const OK = 0;

    /**
     * @return boolean
     */
    public function isError();

    /**
     * @return int
     */
    public function getLevel();

    /**
     * @return string
     */
    public function getLabel();
}
