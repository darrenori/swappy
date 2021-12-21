<?php

//jwt token

require $_SERVER['DOCUMENT_ROOT'].'/swapproj/api/vendor/autoload.php';

use \Firebase\JWT\JWT;

class Pages {

    private $key = 'jnsdn&@71j`83$38ds9n';


    public function auth($array){
        $iat = time();
        $exp = $iat + 60 * 10000000000000; //when it expires
        $payload = array(
            'iss' => 'http://www.swapamc.com/swapproj', //issuer
            'audience' => 'http://www.swapamc.com/', //audience
            'iat' => $iat, //time JWT was issued
            'exp' => $exp, //time JWT expires
            'array' => $array
        );

        $jwt = JWT::encode($payload,$this->key,'HS512');
        return array(
            'token'=>$jwt,
            'expires'=>$exp
        );
    }

    public function updateauth($array,$iat,$exp){

        
        $payload = array(
            'iss' => 'http://www.swapamc.com/swapproj', //issuer
            'audience' => 'http://www.swapamc.com/', //audience
            'iat' => $iat, //time JWT was issued
            'exp' => $exp, //time JWT expires
            'array' => $array
        );

        $jwt = JWT::encode($payload,$this->key,'HS512');
        return array(
            'token'=>$jwt,
            'expires'=>$exp
        );

        

    }


    public function read($token){
        $headers = apache_request_headers();
        //$token = str_replace();
    

        try {
            $token = JWT::decode($token,$this->key,array('HS512'));
            return $token;
        } catch (\Exception $e){
            return false;
        }
    }
}