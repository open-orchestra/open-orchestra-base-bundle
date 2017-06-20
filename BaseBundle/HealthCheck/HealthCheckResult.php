<?php

namespace OpenOrchestra\BaseBundle\HealthCheck;

/**
 * Class HealthCheckResult
 */
class HealthCheckResult
{
    protected $results = array();

    /**
     * @param HealthCheckTestResultInterface $result
     */
    public function addResult(HealthCheckTestResultInterface $result)
    {
        $this->results[] = $result;
    }

    /**
     * @param int $level
     *
     * @return bool
     */
    public function isSuccess($level = HealthCheckTestResultInterface::WARNING)
    {
        /** @var HealthCheckTestResultInterface $result */
        foreach ($this->results as $result) {
            if (true === $result->isError() && $result->getLevel() >= $level){
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}