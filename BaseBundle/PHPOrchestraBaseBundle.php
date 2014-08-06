<?php

namespace PHPOrchestra\BaseBundle;

use PHPOrchestra\BaseBundle\DependencyInjection\Compiler\TwigAvailableLanguagesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class PHPOrchestraBaseBundle
 */
class PHPOrchestraBaseBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigAvailableLanguagesCompilerPass());
    }
}
