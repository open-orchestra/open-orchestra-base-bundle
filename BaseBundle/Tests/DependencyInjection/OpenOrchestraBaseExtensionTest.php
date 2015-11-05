<?php

namespace OpenOrchestra\BaseApiBundle\DependencyInjection;

use OpenOrchestra\BaseBundle\DependencyInjection\OpenOrchestraBaseExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class OpenOrchestraBaseExtensionTest
 */
class OpenOrchestraBaseExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test default value configuration
     */
    public function testDefaultConfig()
    {
        $container = $this->loadContainerFromFile('empty');

        $this->assertEquals(array('en', 'fr'), $container->getParameter('open_orchestra_base.administration_languages'));
        $this->assertEquals('ThisKeyIsNotSecret', $container->getParameter('open_orchestra_base.encryption_key'));
        $this->assertEquals('doctrine.odm.mongodb.document_manager', $container->getAlias('object_manager'));
        $this->isNull($container->getParameter('open_orchestra')['version']);
    }

    /**
     * Test configuration with value
     */
    public function testConfigWithValue()
    {
        $container = $this->loadContainerFromFile('value');

        $this->assertEquals(array('fake_language', 'fake_language2'), $container->getParameter('open_orchestra_base.administration_languages'));
        $this->assertEquals('fake_encryption', $container->getParameter('open_orchestra_base.encryption_key'));
        $this->assertEquals('fake_object_manager', $container->getAlias('object_manager'));
        $this->assertEquals('fake_version', $container->getParameter('open_orchestra')['version']);
    }

    /**
     * @param string $file
     *
     * @return ContainerBuilder
     */
    private function loadContainerFromFile($file)
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', false);
        $container->setParameter('kernel.cache_dir', '/tmp');
        $container->registerExtension(new OpenOrchestraBaseExtension());

        $locator = new FileLocator(__DIR__ . '/Fixtures/config/');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load($file . '.yml');
        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();

        return $container;
    }
}
