<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class FilterTypePaginationCompilerPass
 */
class FilterTypePaginationCompilerPass extends AbstractTaggedCompiler implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $managerName = 'open_orchestra_pagination.filter_type.manager';
        $tagName = 'open_orchestra_pagination.filter_type.strategy';

        $this->addStrategyToManager($container, $managerName, $tagName);
    }
}
