<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Class HealthCheckTestResult
 */
class HealthCheckTestResult implements HealthCheckTestResultInterface
{
    protected $error;
    protected $level;
    protected $label;

    /**
     * @param bool   $error
     * @param string $label
     * @param int    $level
     */
    public function __construct($error, $label, $level)
    {
        $this->error = $error;
        $this->level  = $level;
        $this->label = $label;
    }

    /**
     * @return boolean
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}