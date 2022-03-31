<?php

namespace App\Repository;

use App\Models\FlightDetail;


class FlightDetailsRepository
{
    protected $model;

    /**
     * Constructor for FlightDetailsRepository class.
     * 
     */
    public function __construct(FlightDetail $FlightDetail)
    {
        $this->model = $FlightDetail;
    }

    /**
     * find data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  object
     * @return object
     */
    public function find($data): object
    {
        // Find Data
        return $this->model::where('id', $data['id'])->firstOrFail();
    }

    /**
     * Store data in database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  object
     * @return object
     */
    public function create($data): object
    {
        //save id_proof file in local storage
        $file = $data->file('id_proof');
        $file_name = $data->phone_number;
        $file->move(public_path('id_proof'), $file_name);

        //insert path in message
        $data["id_proof"] = '\id_proof\ ' . $file_name;

        return $this->model->create($data->only(
            'departure_date',
            'return_date',
            'departure_city',
            'departure_country',
            'destination_city',
            'destination_country',
            'booking_class',
            'ticket_type',
            'id_proof',
            'person_id'
        ));
    }

    /**
     * Update data in database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  object
     * @return bool
     */
    public function update($data): bool
    {
        // Update Data
        $this->model::where('id', $data['id'])->firstOrFail('id')
            ->update($data->only(
                'departure_date',
                'return_date'
            ));

        return $this->model::where('id', $data['id'])->firstOrFail('id')
            ->update($data->only(
                'departure_date',
                'return_date'
            ));
    }

    /**
     * Delete data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  object
     * @return bool
     */
    public function delete($data): bool
    {
        // Delete Data
        return $this->model::where('id', $data['id'])->firstOrFail()
            ->delete();
    }
}
