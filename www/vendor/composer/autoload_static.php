<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7aac226ba2a7aed38ccdf190b7ef8367
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\views\\' => 10,
            'app\\models\\' => 11,
            'app\\core\\' => 9,
            'app\\controllers\\' => 16,
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/views',
        ),
        'app\\models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'app\\core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/core',
        ),
        'app\\controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7aac226ba2a7aed38ccdf190b7ef8367::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7aac226ba2a7aed38ccdf190b7ef8367::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
