<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCollectionMeanMacro();
        $this->registerCollectionStandardDeviation();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function registerCollectionStandardDeviation()
    {
        Collection::macro('standardDeviation',function  ($bSample = false)
        {
            $collection = collect($this->items);

            $fMean = $collection->sum() / $collection->count();
            $fVariance = 0.0;
            foreach ($collection->toArray() as $i)
            {
                $fVariance += pow($i - $fMean, 2);
            }
            $fVariance /= ( $bSample ? count($collection) - 1 : count($collection) );
            return (float) sqrt($fVariance);
        });
    }


    private function registerCollectionMeanMacro()
    {
        Collection::macro('mean',function () {
            /**
             * @var $collection Collection
             */

            $collection = collect($this->items);
            return $collection->sum() /  $collection->count();
        });
    }
}
