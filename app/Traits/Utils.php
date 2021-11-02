<?php

namespace App\Traits;

trait Utils {

  public function responses($array, $status = 200, $err = false) {
    $response = array(
        'err' => $err,
        'msg' => $array,
    );
    return response()->json($response, $status);
  }
}