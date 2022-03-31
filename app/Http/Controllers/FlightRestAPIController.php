<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateRequest;
use App\Repository\CountryRepository;
use App\Services\ConfirmationMessage;
use App\Http\Requests\FlightDetailRequest;
use App\Repository\FlightDetailsRepository;
use App\Repository\PersonDetailsRepository;

class FlightRestAPIController extends Controller
{
    protected $flightData;
    protected $personData;
    protected $country;
    protected $message;

    /**
     * Constructor for FlightRestAPIController class.
     */
    public function __construct(
        FlightDetailsRepository $flightData,
        PersonDetailsRepository $personData,
        CountryRepository $country,
        ConfirmationMessage $message
    ) {
        $this->flightData = $flightData;
        $this->personData = $personData;
        $this->country = $country;
        $this->message = $message;
    }

    /**
     * find data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  \Illuminate\Http\UpdateReques  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request): object
    {

        try {
            // Call show flight details
            $data = $this->flightData->find($request);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __('errorMessage.NotFound')],
                404
            );
        }
        return  response()->json(
            [
                'data' => $data->only(
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
                ),
                'message' => 'Data retrived successfully'
            ],
            200
        );
    }

    /**
     * Store data in database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  \Illuminate\Http\FlightDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlightDetailRequest $request): object
    {
        try {
            // Insert Person details in DB
            $this->personData->create($request);

            // Get latest Id
            $personId = $this->personData->getLatestId();

            // Insert latest_id in request
            $request["person_id"] = $personId->id;

            // Call create flight details
            $this->flightData->create($request);

            // Get Message service
            $request = $this->message->getMessage($request);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __('errorMessage.Error')],
                500
            );
        }
        return  response()->json(
            ['message' => 'Data submitted successfully'],
            200
        );
    }

    /**
     * Update data in database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  \Illuminate\Http\UpdateReques  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request): object
    {

        try {
            // Call update flight details
            $this->flightData->update($request);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __('errorMessage.NotFound')],
                404
            );
        }
        return  response()->json(
            ['message' => 'Data with id:' . $request['id'] . ' updated successfully'],
            200
        );
    }

    /**
     * Delete data from database.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  \Illuminate\Http\UpdateReques  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request): object
    {

        try {
            // Call delete flight details
            $this->flightData->delete($request);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => __('errorMessage.NotFound')],
                404
            );
        }
        return  response()->json(
            ['message' => 'Data deleted successfully'],
            200
        );
    }
}
