<?php

namespace OpenOrchestra\BaseBundle\Mapping\Reader;

use Doctrine\Common\Annotations\AnnotationReader;
use OpenOrchestra\Mapping\Annotations\Search;

/**
 * Class SearchMappingReader
 */
class SearchMappingReader
{
    protected $reader;

    /**
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param mixed $class
     *
     * @return array
     */
    public function extractMapping($class)
    {
        $mapping = array();
        $class = new \ReflectionClass($class);
        foreach ($class->getProperties() as $reflectionProperty) {
            $annotations = $this->reader->getPropertyAnnotations($reflectionProperty);
               foreach($annotations as $annotation) {
                   if ($annotation instanceof Search && null !== $annotation->getKey()) {
                       if (null === $annotation->getField()) {
                           $annotation->setField($reflectionProperty->getName());
                       }
                       $mapping[$annotation->getKey()] = $annotation;
                   }
               }
            }

        return $mapping;
    }
}
