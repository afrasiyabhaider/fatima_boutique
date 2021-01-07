<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
	'facebook' => [
    'client_id' => env('FB_APP_ID'),
    'client_secret' => env('FB_APP_SECRET'),
    'redirect' => env('FB_CALLBACK_URL'),
    ],
    'twitter' => [
	    'client_id'      => env('TW_APP_ID'),
	    'client_secret'  => env('TW_APP_SECRET'),
	    'redirect'       => env('TW_CALLBACK_URL'),
    ],
    'google' => [ 
        'client_id'      => env('GOOG_APP_ID'),
         'client_secret' => env('GOOG_APP_SECRET'),
         'redirect'      => env('GOOG_CALLBACK_URL'),'http://localhost/marketplace/login/google/callback', 
    ],
	/*'google' => [ 
        'client_id'      => '',
         'client_secret' => '',
         'redirect'      => 'http://localhost/marketplace/login/google/callback', 
        ],
	'twitter' => [
	    'client_id'      => '',
	    'client_secret'  => '',
	    'redirect'       => 'http://localhost/marketplace/login/twitter/callback',
			],
    'github' => [
         'client_id' => 'af54e6bae9a4edfc6cbb',
         'client_secret' => '95afc7b40e6aca6419a7623c34bb6d86cb2ac',
         'redirect' => 'http://localhost/marketplace/login/github/callback',
            ],
	'linkedin' => [
         'client_id' => 'af54e6bae9a4edfc6cbb',
         'client_secret' => '95afc7b40e6aca6419a7623c34bb6d86cb2ac',
         'redirect' => 'http://localhost/marketplace/login/linkedin/callback',
            ],*/				
    'stripe' => [
        'model' => Responsive\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	
	
	
	
		/*'github' => [
	
	'client_id' => 'af54e6bae9a4edfc6cbb',
	
	'client_secret' => '95afc7b40e6aca6419a7623c34bb6d86cb2ac',
	
	'redirect' => 'http://localhost/marketplace/login/github/callback',
	
	      ],

			'twitter' => [
			
			'client_id' => '8JS1GvRflY5g9N3kZc0heYTqL',
			
			'client_secret' => 'eYujptPLBAAzdHIz8hiqGgz4MkJTcmL1JAGEuEZsGU1MykjK',
			
			'redirect' => 'http://localhost/marketplace/login/twitter/callback',
			
			],*/
	
	

];
