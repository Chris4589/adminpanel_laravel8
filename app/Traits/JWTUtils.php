<?php

namespace App\Traits;

use Firebase\JWT\JWT;

trait JWTUtils {
  
  private $key = "test";

  public function JWTSign($payload) {
    $jwt = JWT::encode($payload, $this->key);

    return $jwt;
  }

  public function JWTVerifity($token) {
    try {
      $token = JWT::decode($token, $this->key, array('HS256'));
      return $token;
    } catch (\UnexpectedValueException $th) {
      return false;
    }
  }

}