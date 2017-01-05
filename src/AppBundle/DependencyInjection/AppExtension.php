<?php
/**
 * Created by PhpStorm.
 * User: vali
 * Date: 02.12.2016
 * Time: 17:14
 */

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../../app/config')
        );
        $loader->load('admin.yml');
    }
}