<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit93198a829b8a479436fe753701daac59
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'I' => 
        array (
            'Ifrahvermeer\\Gallery\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Ifrahvermeer\\Gallery\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit93198a829b8a479436fe753701daac59::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit93198a829b8a479436fe753701daac59::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit93198a829b8a479436fe753701daac59::$classMap;

        }, null, ClassLoader::class);
    }
}
