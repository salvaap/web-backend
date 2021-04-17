<?php

namespace App\Providers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView(function () { return view('auth.login'); });
        Fortify::registerView(function () { return view('auth.register'); });
        Fortify::requestPasswordResetLinkView(function () { return view('auth.forgot-password'); });
        Fortify::resetPasswordView(function ($request) { return view('auth.reset-password', ['request' => $request]); });
        Fortify::verifyEmailView(function () { return view('auth.verify-email'); });
        Fortify::authenticateUsing(function(Request $request) {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string'],
            ];
            $messages = [
                'email.required' => 'El correo electrónico es requerido.',
                'email.string' => 'El correo delectrónico debe ser una cadena de caracteres.',
                'email.email' => 'El correo electrónico proporcionado no es válido.',
                'password.required' => 'La contraseña es requerida.',
                'password.string' => 'La contraseña debe ser una cadena de caracteres.'
            ];
            $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
            Validator::make($credentials, $rules, $messages)->validate();

            $user = User::where('email', trim($request->get('email')))->first();

            if($user && Hash::check($request->get('password'), $user->password)) {
                return $user;
            }
            
            return null;
        });
    }
}
