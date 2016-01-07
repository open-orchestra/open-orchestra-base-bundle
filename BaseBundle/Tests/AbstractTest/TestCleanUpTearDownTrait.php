<?php

namespace OpenOrchestra\BaseBundle\Tests;

/**
 * Class TestCleanUpTearDownTrait
 */
trait TestCleanUpTearDownTrait
{
    /**
     * Clean up object
     */
    protected function tearDown()
    {
        $refl = new ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
    }
}