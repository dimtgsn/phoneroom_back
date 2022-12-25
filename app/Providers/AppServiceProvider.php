<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()){
            DB::whenQueryingForLongerThan(CarbonInterval::seconds(5), function (Connection $connection, QueryExecuted $event) {
                logger()
                    ->channel('telegram')
                    ->debug('whenQueryingForLongerThan:' . $connection->totalQueryDuration());
            });

            DB::listen(function ($query) {
                if ($query->time > 100) {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . $query->sql, $query->bindings);
                }
            });

            $kernel = app(Kernel::class);

            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function () {
                    logger()
                        ->channel('telegram')
                        ->debug('whenRequestLifecycleIsLongerThan:' . request()->url);
                }
            );

        }

        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$', $value) && strlen($value) >= 11;
        });

        Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute',$attribute, ':attribute is invalid phone number');
        });

    }
}
