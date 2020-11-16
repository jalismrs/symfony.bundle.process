<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsProcessBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class JalismrsProcessExtension
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsProcessBundle\DependencyInjection
 */
class JalismrsProcessExtension extends
    ConfigurableExtension
{
    /**
     * loadInternal
     *
     * @param array                                                   $mergedConfig
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function loadInternal(
        array $mergedConfig,
        ContainerBuilder $container
    ) : void {
        $fileLocator    = new FileLocator(
            __DIR__ . '/../Resources/config'
        );
        $yamlFileLoader = new YamlFileLoader(
            $container,
            $fileLocator
        );
        $yamlFileLoader->load('services.yaml');
        
        $definition = $container->getDefinition(Configuration::CONFIG_ROOT . '.process_manager');
        $definition->replaceArgument(
            '$cap',
            $mergedConfig['cap']
        );
    }
}
