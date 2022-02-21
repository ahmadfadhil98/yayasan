<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        try{
            $client = new Client();
                $res = $client->request('POST', 'http://103.7.14.55/auth/signin', [
                'form_params' => [
                    'userid' => $input['username'],
                    'password' => $input['password'],
                ]
            ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                $username = $json['payload']["userid"];
                $name = $json['payload']["nama"];
                $email = $username."@mail.com";
                $token = $json['payload']["token"];
                $refreshToken = $json['payload']["refreshToken"];

                $user = User::where('username',$username)->first();

                if(!$user){
                    $user = User::create([
                        'name' => $name,
                        'username' => $username,
                        'email' => $email,
                        'password' => Hash::make($input['password']),
                        'token' => $token,
                        'type' => 1,
                        'refreshToken' => $refreshToken,
                    ]);
                }else{
                    $user->update([
                        'token' => $token,
                        'refreshToken' => $refreshToken,
                    ]);
                }
                $user->roles()->sync(1);
                return $user;

            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
