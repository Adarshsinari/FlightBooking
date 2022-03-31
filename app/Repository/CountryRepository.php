<?php

namespace App\Repository;

use App\Models\Country;

class CountryRepository
{
    protected $model;

    /**
     * Constructor for CountryRepository class.
     */
    public function __construct(Country $Country)
    {
        $this->model = $Country;
    }

    /**
     * Get all data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  
     * @return object
     */
    public function getAllCountries(): object
    {
        return  $this->model::orderBy('id', 'desc')->get();
    }

    /**
     * find data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  $id
     * @return object
     */
    public function findName($id): object
    {
        return $this->model::where('id', $id)->first('country_name');
    }
}
