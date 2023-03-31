<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Builder\Identity;
use Symfony\Component\BrowserKit\Response;

class JwtAuth
{

    public $manager;
    public $key;
    public $topSecret;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        //$this->key = "una-cadena-de-texto-secreta_de_mi_proyecto_de_symfony23567885345667809";
        $this->topSecret = "una-cadena-de-texto-secreta_de_mi_proyecto_de_symfony23567885345667809";
    }

    public function signup($email, $passwd, $gettoken = null)
    {
        //comprobar si el usuario existe
        
        $user = $this->manager->getRepository(User::class)->findOneBy([
            'email' => $email,
            //'passwd' => $passwd,
        ]);

        if(password_verify($passwd, $user->getPasswd())){
            $signup = true;
        }else{
            $signup = false;
        }


        // si existe generar en token

        if ($signup) {
            $token = [
                'sub' => $user->getId(),
                'nickname' => $user->getNickname(),
                'email' => $user->getEmail(),
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60),
            ];
            
            $jwt = JWT::encode($token, $this->topSecret, 'HS256');
            if (!empty($gettoken)){ 
                $data = $jwt;
            }else{
                //$decoded = JWT::decode($jwt, $this->key, 'HS256');
                $decoded = JWT::decode($jwt, new Key( $this->topSecret, 'HS256'));
                $data = $decoded;
            }
        }else{
            $data = [
                'status' => 'error',
                'message' => 'Login incorrecto',
                //'mail' => $email,
                //'passwd' => $passwd 
            ];
        }

        return $data;
    }

    public function checkToken($jwt, $identity = false){
        $auth = false;
        try{
            $decoded = JWT::decode($jwt, new Key( $this->topSecret, 'HS256'));
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }
        

        if(isset($decoded) && !empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($identity){
            return $decoded;
        }else{
            return $auth;
        }

        
    }

}
