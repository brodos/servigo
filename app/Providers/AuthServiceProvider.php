<?php

namespace App\Providers;

use App\Role;
use App\Permission;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Media' => 'App\Policies\MediaPolicy',
        'App\Profile' => 'App\Policies\ProfilePolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Proposal' => 'App\Policies\ProposalPolicy',
        'App\Conversation' => 'App\Policies\ConversationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach(config('settings.roles') as $role) {
            Gate::define($role, function ($user) use ($role) {
                return $user->hasRole($role);
            });    
        }
    }
}
