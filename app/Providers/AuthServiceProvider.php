<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Question;
use App\Policies\QuestionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
	* The model to policy mappings for the application.
	*
	* @var array<class-string, class-string>
	*/
	protected $policies = [
		Question::class => QuestionPolicy::class,
	];
	
	/**
	* Register any authentication / authorization services.
	*/
	public function boot(): void
	{
	    //
	}
}
