<?php

namespace App\Lib\Classes\Services\v1\Auth;

use App\Exceptions\Unauthenticated;
use App\Lib\Classes\Services\BaseService;
use App\Lib\Classes\Services\v1\User\UserService;
use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\EncryptorInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthWithEmailPasswordService extends BaseService implements AuthInterface
{
    public function __construct()
    {
        $this->rules = [
            'user_registration' => [
                'rules' => [
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                    'password_confirmation' => 'same:password|required_with:password',
                    'mobile' => 'required',
                ],
                'message' => 'responses.auth.registration_error',
                'errorCode' => 100
            ],
            'user_login' => [
                'rules' => [
                    'email' => 'required',
                    'password' => 'required',
                ],
                'message' => 'responses.auth.login_error',
                'errorCode' => 100
            ],
            'user_recover_password' => [
                'email' => 'required|exists:users,email'
            ]
        ];
        $this->setCollects(\App\Http\Resources\User::class);
    }

    public function createUser($validData, $notify)
    {
        return User::create([
            'name' => $validData['name'] ?? null,
            'family' => $validData['family'] ?? null,
            'tell' => $validData['tell'] ?? null,
            'email' => $validData['email'] ?? null,
            'password' => Hash::make($validData['password'])
        ]);
    }

    public function register(EncryptorInterface $encryptor, $validData, $notify = true)
    {
        $user = static::createUser($validData, $notify);
        $token = $encryptor->generate(['userId' => $user->id]);
        return static::successOrFailure($user, null, $this->resource($user, false),);
    }

    public function login(EncryptorInterface $encryptor, $validated)
    {
        if (Auth::attempt($validated)) {

            $user = UserService::getUser($validated);

            $this->loginOperations($user);

            $token = $encryptor->generate(['userId' => $user->id]);

            return static::success(__('auth.successAuth'), ['token' => $token], 200);
        }

        throw new Unauthenticated();
    }

    public function recoverPassword($validated)
    {
        $user = UserService::query()->where('email', $validated['email'])->first();

        if ($user) {
            $result = UserService::update($user, [
//                'forgot_password_token' => RandomString::verificationToken(20),
//                'forgot_password_token_exp_date' => Carbon::now()->addMinutes(Config::$passwordRecoveryTokenValidMinutes)
            ]);
//            if ($result) event(new RecoverUserPassword($user));
            return true;
        }
        return false;

    }

    public function loginOperations($user)
    {
        Auth::login($user);
    }
}
