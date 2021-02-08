<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	* The policy mappings for the application.
	*
	* @var array
	*/
	protected $policies = [
		// 'App\Models\UserType' => 'App\Policies\UserTypePolicy',
	];

	/**
	* Register any authentication / authorization services.
	*
	* @return void
	*/
	public function boot()
	{
		$this->registerPolicies();

		$mapsPolicy = [
			[ 'user', ['viewAny', 'create', 'view', 'update', 'delete'] ],
			[ 'userType', ['viewAny', 'create', 'view', 'update', 'delete'] ],
		];

		foreach ($mapsPolicy as $mapPolicy) {
			foreach ($mapPolicy[1] as $action) {
				Gate::define("{$mapPolicy[0]}-{$action}", [ 'App\Policies\\' . ucfirst($mapPolicy[0]) .'Policy', $action ]);
			}
		}
	}
}
