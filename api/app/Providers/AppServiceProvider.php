<?php

namespace App\Providers;

use App\Contract\CandidateInterface;
use App\Contract\JobsInterface;
use App\Contract\PartnerCandidateInterface;
use App\Contract\ProfileInterface;
use App\Contract\RbacInterface;
use App\Contract\ReviewInterface;
use App\Contract\UploadInterface;
use App\Contract\UserInterface;
use App\Service\CandidateService;
use App\Service\JobsService;
use App\Service\PartnerCandidateService;
use App\Service\ProfileService;
use App\Service\RbacService;
use App\Http\Validators\ConfirmCamelcaseValidator;
use App\Service\ReviewService;
use App\Service\UploadService;
use App\Service\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RbacInterface::class, RbacService::class);
        $this->app->singleton(UserInterface::class, UserService::class);
        $this->app->singleton(CandidateInterface::class, CandidateService::class);
        $this->app->singleton(PartnerCandidateInterface::class, PartnerCandidateService::class);
        $this->app->singleton(UploadInterface::class, UploadService::class);
        $this->app->singleton(JobsInterface::class, JobsService::class);
        $this->app->singleton(ProfileInterface::class, ProfileService::class);
        $this->app->singleton(ReviewInterface::class, ReviewService::class);
    }
}
