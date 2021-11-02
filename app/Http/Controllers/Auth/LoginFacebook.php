<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\JWTUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;

class LoginFacebook extends Controller
{
    use JWTUtils;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'accessToken' => 'required',
            'userID' => 'required'
        ];

        $this->validate($request, $rules);

        $accessToken = $request->query('accessToken');
        $userID = $request->query('userID');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v12.0/{$userID}/?fields=id,name,email,picture&access_token={$accessToken}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response);

        if (isset($data->error)) { //isset para ver si esta definida la var
            return $this->responses($data->error->message, 500, true);
        }

        $user = User::where('email', '=', $data->email)->first();

        if ($user) {
            $token = $this->JWTSign($user->id);
            return $this->responses(['user' => $user, 'token' => $token]);
        }
        
        $userfb = array(
            'email' => $data->email,
            'username' => $data->name,
            'password' => bcrypt(uniqid()),
            'foto' => $data->picture->data->url,
        );

        $user = User::create($userfb);
        $token = $this->JWTSign($user->id);

        return $this->responses(['user' => $user, 'token' => $token]);
    }
}
