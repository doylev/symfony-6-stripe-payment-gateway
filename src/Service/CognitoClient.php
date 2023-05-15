<?php

namespace App\Service;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoClient
{
    public function GetCognitoClient():CognitoIdentityProviderClient {
       return new CognitoIdentityProviderClient(array(
           'profile' => 'default',
           'region' => 'us-east-1'
       ));
    }
}