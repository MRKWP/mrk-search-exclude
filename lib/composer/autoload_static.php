<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ba916dd8914a4e2b2622624906b1ad8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MRK_Search_Exclude\\' => 19,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MRK_Search_Exclude\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ba916dd8914a4e2b2622624906b1ad8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ba916dd8914a4e2b2622624906b1ad8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4ba916dd8914a4e2b2622624906b1ad8::$classMap;

        }, null, ClassLoader::class);
    }
}
