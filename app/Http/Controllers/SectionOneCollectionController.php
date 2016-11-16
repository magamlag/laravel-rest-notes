<?php

namespace App\Http\Controllers;

class SectionOneCollectionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * @var $collection \Illuminate\Support\Collection
         */
        $collection = collect(
            [13, 24, 91, 120, 41, 76, 91, 46, 71, 101, 259, 12, 41, 28, 73, 33, 58]
        );

        return [
            'input_data'    =>  $collection->toArray(),
            'mean'          =>  $collection->mean(),
            'median'        =>  $collection->median(),
            'average'       =>  $collection->avg(),
            'mode'          =>  $collection->mode(),
            'standardDeviation' =>  $collection->standardDeviation()
        ];
    }
}
