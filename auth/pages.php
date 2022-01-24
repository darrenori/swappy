<?php

//jwt token

require $_SERVER['DOCUMENT_ROOT'].'/swapproj/api/vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Pages {

private $privatekey = '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----';



private $publickey = '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAytnSy2CbjUYiqHq1SZku
pNyme5Cfm5meKTYfN9YdN5UWUo7c/B0I8pakplidujSBBiUp7yG4Wqu8TejSn+7t
VdlSkcylrpVWP2Tic8bxdUPVgzz/qPsGDvxx0DtuCYwvtJz3zJ8VVyNrOF15a+28
UvOfmzQuve5BmfK5XvxSOnAB/Z//pWCkyv9Yph+iyHfe6eHvSlOWqkarmGvCj5rd
9/s33EqxmiHu8eVqbTnCHIMxNavGotpGupo4FP/qEU6MU/kbr20bNh/7MCti1bOs
BV3TXtOvOFAeRPef5znrJ+zFOWdCE3uD3wh6RDalA/fCU1eRyN9Qu4OdhY/nnVQ9
dls9nko+h6LoxO0ltYEYZWmhhp7Xfa3ZnXaoM0U313xiZq4BnXP8005WZhNj2A0J
TKMgdeRuEtRhUBa5TCxTXQT4Om3ryAs7IPqu/0uEzWRPs9TiS15f6mQXPzVqmo6F
KWMONMNp/DUK/Ild+o05dxMo2x1ptzTDl/Q+WcVDUcOu/WJUD3Yp7o1fMFdcJkNJ
AqASPgbkl7KCJHAfAGnQcfURmMXtup+bMQuyiXxHtniqZ8i790j9Uk9OvGwSpJDt
B6XI+FWKrptk0Fjzx9Kf+yUSWA+xOhj7NZDd/13Ag2UTgEULva8KLWMd95DliR9h
Bl+RY4igtBECQr4qsqgAYTMCAwEAAQ==
-----END PUBLIC KEY-----';


    public function auth($array){
        $iat = time();
        $exp = $iat + 363333333333330 * 3; //when it expires
        $payload = array(
            'iss' => 'http://www.swapamc.com/swapproj', //issuer
            'audience' => 'http://www.swapamc.com/', //audience
            'iat' => $iat, //time JWT was issued
            'exp' => $exp, //time JWT expires
            'array' => $array
        );

        $jwt = JWT::encode($payload,$this->privatekey,'RS256');
        return array(
            'token'=>$jwt,
            'expires'=>$exp
        );
    }

    public function updateauth($array,$iat,$exp){
        $iat = time();

        
        $payload = array(
            'iss' => 'http://www.swapamc.com/swapproj', //issuer
            'audience' => 'http://www.swapamc.com/', //audience
            'iat' => $iat, //time JWT was issued
            'exp' => $exp, //time JWT expires
            'array' => $array
        );

        $jwt = JWT::encode($payload,$this->privatekey,'RS256');
        return array(
            'token'=>$jwt,
            'expires'=>$exp
        );

        

    }


    public function read($token){
        // $headers = apache_request_headers();
        //$token = str_replace();

        
    

        try {
            $token = JWT::decode($token,new Key($this->publickey,'RS256'));
            $token = (array) $token;
            return $token;
        } catch (\Exception $e){
            return false;
        }
    }


    public function regenerate($array,$exp){
        // $headers = apache_request_headers();
        //$token = str_replace();

        $iat = time();

        
        $payload = array(
            'iss' => 'http://www.swapamc.com/swapproj', //issuer
            'audience' => 'http://www.swapamc.com/', //audience
            'iat' => $iat, //time JWT was issued
            'exp' => $exp, //time JWT expires
            'array' => $array
        );

        $jwt = JWT::encode($payload,$this->privatekey,'RS256');
        return array(
            'token'=>$jwt,
            'expires'=>$exp
        );

        
    

        
    }
}