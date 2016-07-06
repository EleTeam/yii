<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii',
            'username' => 'root',
//            'dsn' => 'mysql:host=120.24.54.172;dbname=yii',
//            'username' => 'yii',
            'password' => '123456',
            'charset' => 'utf8',
            //'tablePrefix' => 'pre_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
