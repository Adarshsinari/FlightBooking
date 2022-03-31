<?php

namespace App\Repository;

use App\Models\PersonDetail;

class PersonDetailsRepository
{
    protected $model;

    /**
     * Constructor for PersonDetailsRepository class.
     */
    public function __construct(PersonDetail $PersonDetail)
    {
        $this->model = $PersonDetail;
    }

    /**
     * Store data in database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  object
     * @return object
     */
    public function create($data) :object
    {
       
        return $this->model->create($data->only(
            'salutation',
            'first_name',
            'last_name',
            'date_of_birth',
            'email',
            'phone_number',
            'address',
            'city',
            'state',
            'zip_code',
            'country',
        ));
    }

    /**
     * Get data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  
     * @return object
     */
    public function getLatestId(): object
    {
        return $this->model->latest()->first('id');
    }
}
