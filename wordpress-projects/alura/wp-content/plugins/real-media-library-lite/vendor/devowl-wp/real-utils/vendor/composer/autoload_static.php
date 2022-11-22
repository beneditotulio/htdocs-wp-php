<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita56adc024fd7564f34db6321f1dafa4c
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DevOwl\\RealUtils\\Test\\' => 22,
            'DevOwl\\RealUtils\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DevOwl\\RealUtils\\Test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/test/phpunit',
        ),
        'DevOwl\\RealUtils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita56adc024fd7564f34db6321f1dafa4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita56adc024fd7564f34db6321f1dafa4c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}