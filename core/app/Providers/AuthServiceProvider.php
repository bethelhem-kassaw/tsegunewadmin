<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ResetPassword::createUrlUsing(function ($user, string $token) {
        //     $userTypeUrl = "/reset-password/";
        //     $prev = session('_previous')['url'];
        //     if (strpos($prev, 'admin'))
        //     {
        //         $userTypeUrl = '/admin/password/reset/';
        //     }
        //     $url = env('APP_URL').$userTypeUrl.$token.'&email='.$user->email;
        //     return $url;
        // });
    }
}
