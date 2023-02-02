<?php
return [
    'components' => [
         'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=iarcdb-live',
            'username' => 'iarcdbmain',
            'password' => 'vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6',
            'charset' => 'utf8',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			'transport' => [
            'class' => 'Swift_SmtpTransport',
            //'host' => 'smtp.office365.com',
            //'host' => 'smtp.gmail.com',
            //'username' => 'notifications@industryarc.com',
            //'username' => 'salesrequest19@gmail.com',
            //'password' => 'Xut41473',
            //'password' => 'pwmhymsrjfzpsyma',
            
	    //'host' => 'in-v3.mailjet.com',	
	    //'username' => 'salesrequest19@gmail.com',
            //'password' => 'Iarc7878@',

	    'host' => 'smtp.gmail.com',	
	    'username' => 'salesrequest19@gmail.com',
            'password' => 'psfxsxipjhfzquur',

	

	    'port' => '587',
            'encryption' => 'tls',
            ],
        ],


        'mailer2' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            //'host' => 'smtp.office365.com',
            //'host' => 'smtp.gmail.com',
            //'username' => 'notifications@industryarc.com',
            //'username' => 'salesrequest19@gmail.com',
            //'password' => 'Xut41473',
            //'password' => 'pwmhymsrjfzpsyma',
            
        //'host' => 'in-v3.mailjet.com',    
        //'username' => 'salesrequest19@gmail.com',
            //'password' => 'Iarc7878@',

        'host' => 'smtp.gmail.com', 
        'username' => 'salesiarc123@gmail.com',
            'password' => 'mzwxmxsyohthlisp',

    

        'port' => '587',
            'encryption' => 'tls',
            ],
        ],
    ],
];
