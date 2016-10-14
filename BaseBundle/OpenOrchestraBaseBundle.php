<?php

namespace OpenOrchestra\BaseBundle;

use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\TwigAvailableLanguagesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraBaseBundle
 */
class OpenOrchestraBaseBundle extends Bundle
{
    const VERSION = '1.1.5';
    const VERSION_ID = 10105;
    const MAJOR_VERSION = 1;
    const MINOR_VERSION = 1;
    const RELEASE_VERSION = 5;
    const EXTRA_VERSION = 'STABLE';

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigAvailableLanguagesCompilerPass());
    }
}
