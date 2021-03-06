<?php

namespace OpenOrchestra\BaseBundle;

use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\TwigAvailableLanguagesCompilerPass;
use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\HealthCheckCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraBaseBundle
 */
class OpenOrchestraBaseBundle extends Bundle
{
    const VERSION = '2.0.1';
    const VERSION_ID = 20001;
    const MAJOR_VERSION = 2;
    const MINOR_VERSION = 0;
    const RELEASE_VERSION = 1;
    const EXTRA_VERSION = 'STABLE';

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigAvailableLanguagesCompilerPass());
        $container->addCompilerPass(new HealthCheckCompilerPass());
    }
}
