<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "mail", "sendmail", "mailgun", "mandrill",
    |            "ses", "sparkpost", "log"
    |
    */

    'driver' => 'smtp',
//    'driver' => 'log',
    'host' => 'mailtrap.io',
    'port' => 2525,
    'from' => [
        'address' => 'management@abc168.space',
        'name' => '金豪買',
    ],

    'encryption' => 'tls',
    'username' => '2d3c21ceddd1a3',
    'password' => '42e61802cca3d1',

    /*
    |--------------------------------------------------------------------------
    | Sendmail System Path
    |--------------------------------------------------------------------------
    |
    | When using the "sendmail" driver to send e-mails, we will need to know
    | the path to where Sendmail lives on this server. A default path has
    | been provided here, which will work well on most of your systems.
    |
    */
    'sendmail' => '/usr/sbin/sendmail -bs',
];
