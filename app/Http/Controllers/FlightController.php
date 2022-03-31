<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightDetailRequest;
use App\Repository\FlightDetailsRepository;
use App\Repository\PersonDetailsRepository;
use App\Repository\CountryRepository;
use App\Services\ConfirmationMessage;


class FlightController extends Controller
{
    protected $flight_repo;
    protected $person_repo;
    protected $country_repo;
    protected $message_service;

    /**
     * Constructor for FlightController class.
     */
    public function __construct(
        FlightDetailsRepository $flight_repo,
        PersonDetailsRepository $person_repo,
        CountryRepository $country_repo,
        ConfirmationMessage $message_service
    ) {
        $this->flight_repo = $flight_repo;
        $this->person_repo = $person_repo;
        $this->country_repo = $country_repo;
        $this->message_service = $message_service;
    }

    /**
     * display index page with required data.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  none
     * @return \Illuminate\Http\view
     */
    public function index(): object
    {
        $countries = $this->country_repo->getAllCountries();
        return view('flights.index')->with('countries', $countries);
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
            $this->person_repo->create($request);

            // Get latest Id
            $personId = $this->person_repo->getLatestId();

            // Insert latest_id in request
            $request["person_id"] = $personId->id;

            // Call create flight details
            $this->flight_repo->create($request);

            // Get Message service
            $request = $this->message_service->getMessage($request);
        } catch (\Exception $e) {
            return response()->json([
                // Error message
                'errors' => [
                    [
                        'message' => __('errorMessage.Error')
                    ],
                ]
            ], 500);
        }
        return  response()->json($request->only(
            'departure_date',
            'return_date',
            'departure_city',
            'departure_country',
            'destination_city',
            'destination_country',
            'booking_class',
            'ticket_type'
        ));
    }
}
