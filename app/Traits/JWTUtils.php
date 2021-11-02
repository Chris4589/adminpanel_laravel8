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
      $decoded = JWT::decode($token, $this->key, array('HS256'));
      return $decoded->id;
    } catch (\UnexpectedValueException $th) {
      return 'Token invalido';
    }
  }

}