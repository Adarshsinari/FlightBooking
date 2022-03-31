<?php

namespace App\Services;

use App\Repository\CountryRepository;

class ConfirmationMessage
{
    protected $country;

    /**
     * Constructor for ConfirmationMessage class.
     */
    public function __construct(CountryRepository $country)
    {
        $this->country = $country;
    }

    /**
     * Converts data into proper format.
     * @date 21-03-2022
     * @author Adarsh Sinari
     * @param  none
     * @return \Illuminate\Http\view
     */
    public function getMessage($message): object
    {
        //get names of Countries
        $message['departure_country'] = $this->country->findName($message->departure_country);
        $message['destination_country'] = $this->country->findName($message->destination_country);

        //change date format to d-m-Y
        $message['departure_date'] = date("d-m-Y", strtotime($message->departure_date));
        $message['return_date'] = date("d-m-Y", strtotime($message->return_date));

        return $message;
    }
}
