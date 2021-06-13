<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb5d8a5ae7f24a371af171e854a85562d
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb5d8a5ae7f24a371af171e854a85562d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb5d8a5ae7f24a371af171e854a85562d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
