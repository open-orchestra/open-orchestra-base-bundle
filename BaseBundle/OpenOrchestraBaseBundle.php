<?php

namespace OpenOrchestra\BaseBundle;

use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\FilterTypePaginationCompilerPass;
use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\TwigAvailableLanguagesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraBaseBundle
 */
class OpenOrchestraBaseBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigAvailableLanguagesCompilerPass());
        $container->addCompilerPass(new FilterTypePaginationCompilerPass());
    }
}
