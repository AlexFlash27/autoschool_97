<?php
return [
    'language' => 'ru-RU',
    'name' => 'Autoschool-test',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'assetManager' => [
            'linkAssets' => true,
        ],*/
    ],
];
