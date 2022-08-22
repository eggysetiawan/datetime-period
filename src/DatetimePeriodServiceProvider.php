<?php

namespace Eggysetiawan\DatetimePriod;

use Eggysetiawan\DatetimePriod\Facade\Date;
use Eggysetiawan\DatetimePriod\Supports\DateSupport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date as FacadesDate;
use Illuminate\Support\ServiceProvider;

class DatetimePeriod extends ServiceProvider
{
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(FacadesDate::class, DateSupport::class);
    }

    public function boot()
    {
        Builder::macro('from', function ($key, $value) {
            return $this->where($key, '>=', "$value 00:00:00");
        });

        Builder::macro('to', function ($key, $value) {
            return $this->where($key, '<=', "$value 23:59:59");
        });

        Builder::macro('whereDayBetween', function ($key, $date, $time = true) {
            return $this->whereBetween($key, Date::dayBetween($date, $time));
        });

        Builder::macro('whereMonthBetween', function ($key, $month, $year, $time = false) {
            return $this->whereBetween($key, Date::monthBetween($month, $year, $time));
        });

        Builder::macro('whereYearBetween', function ($key, $year, $time = false) {
            return $this->whereBetween($key, Date::yearBetween($year, $time));
        });

        Builder::macro('whereMonthUntil', function ($key, $month, $year, $time = false) {
            return $this->where($key, '<=', Date::monthUntil($month, $year, $time));
        });
    }
}
