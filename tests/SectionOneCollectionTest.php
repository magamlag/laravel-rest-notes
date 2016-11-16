<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SectionOneCollectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCollectionResponseStructure()
    {


        $this->visitRoute('section.one.collection')
            ->seeJsonStructure([
                'input_data',
                'mean',
                'median',
                'average',
                'mode',
                'standardDeviation'
            ]);
    }

    public function testCollectionResponseValid()
    {
        $collection = collect(
            [13, 24, 91, 120, 41, 76, 91, 46, 71, 101, 259, 12, 41, 28, 73, 33, 58]
        );

        $this->visitRoute('section.one.collection')
            ->seeJsonEquals([
                'input_data'    =>  $collection->toArray(),
                'mean'          =>  $collection->mean(),
                'median'        =>  $collection->median(),
                'average'       =>  $collection->avg(),
                'mode'          =>  $collection->mode(),
                'standardDeviation' =>  $collection->standardDeviation()
            ]);
    }
}
