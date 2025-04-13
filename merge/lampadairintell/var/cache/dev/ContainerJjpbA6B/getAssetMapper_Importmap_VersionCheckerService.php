<?php

namespace ContainerJjpbA6B;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAssetMapper_Importmap_VersionCheckerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'asset_mapper.importmap.version_checker' shared service.
     *
     * @return \Symfony\Component\AssetMapper\ImportMap\ImportMapVersionChecker
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'asset-mapper'.\DIRECTORY_SEPARATOR.'ImportMap'.\DIRECTORY_SEPARATOR.'ImportMapVersionChecker.php';

        return $container->privates['asset_mapper.importmap.version_checker'] = new \Symfony\Component\AssetMapper\ImportMap\ImportMapVersionChecker(($container->privates['asset_mapper.importmap.config_reader'] ?? $container->load('getAssetMapper_Importmap_ConfigReaderService')), ($container->privates['asset_mapper.importmap.remote_package_downloader'] ?? $container->load('getAssetMapper_Importmap_RemotePackageDownloaderService')));
    }
}
