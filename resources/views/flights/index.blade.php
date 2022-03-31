@extends('app')

@section('content')

<div class="container  mb-5  pt-3" id="con" >
    <!-- PersonalDetails -->
    <div class="card mx-auto p-3 shadow-lg" style=" width:500px; " >
    <div class=" row mb-2 mx-auto "  style="  width:465px; ">
        
        <div class="btn-group px-0 " role="group" aria-label="Basic checkbox toggle button group" >
        <input type="checkbox" class="btn-check change2"  name="btnradio" id="btnradio1" autocomplete="off" onclick=""  checked>
        <label class=" btn btn-dark  btn-outline-warning " for="btnradio1">Personal Details</label>

        <input type="checkbox" class="btn-check change1" name="btnradio" id="btnradio2" autocomplete="off" onclick="">
        <label class="btn btn-dark btn-outline-warning" for="btnradio2">Flight Details</label>
        </div>
    </div>
  
    <form class="" style="display:block" id='formData' action="{{ route('flights.store') }}" method="POST" enctype="multipart/form-data" name='PersonAndFlightData' >
    <div class="row " style="display:block" id='PersonDiv' >
    @csrf
    
    
    <!-- salutation -->    
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Salutation</label>
            <select class="form-select form-control  "  id="salutation" name="salutation"  >
                <option class="" value="" disabled selected hidden>Enter Salutation</option>   
                <option value="Mr." {{ old('salutation') == "Mr." ? 'selected' : '' }}>Mr.</option>
                <option value="Ms." {{ old('salutation') == "Ms." ? 'selected' : '' }}>Ms.</option>
            </select>   
        </div>

        <!-- Firstname -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">First name</label>
            <div class="input-group " >
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{old('first_name')}}">
            </div>
        </div>

         <!-- Lastname -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Last Name</label>
            <div class="input-group ">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last name" value="{{old('last_name')}}">
            </div>
        </div>

           <!-- Date Of Birth -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Date Of Birth</label>           
            <div class="input-group ">
            <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth')}}" placeholder="Enter DOB" onfocus="(this.type='date')" >
            </div>
        </div>
        

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Email</label>
            <div class="input-group " >
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{old('email')}}">
            </div>
        </div>
      
        <!-- phone no-->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Phone Number</label>
            <div class="input-group ">
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone number" value="{{old('phone_number')}}">
            </div>
        </div>
       
        <!-- Address-->
        <div class=" ">
            <label class="form-label d-flex align-items-start">Address</label>
            <div class="input-group ">
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{old('address')}}"  >
            </div>
        </div>

        <div class="row g-3 m-auto mb-3">   
        <!-- city-->
            <div class="col-md-6 ">
            <div class="input-group  ">
            <input type="text" class="form-control" id="city" name="city" placeholder="City"  value="{{old('city')}}">
            </div>
            </div>

            <!-- state-->
            <div class="col-md-6 ">
            <div class="input-group  ">
                <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{old('state')}}">
            </div>
            </div>

            <!-- zipcode-->
            <div class="col-md-6 ">
            <div class="input-group  ">
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter Postcode " value="{{old('zip_code')}}">
            </div>
            </div>

            <!-- country-->
            <div class="col-md-6 ">
            <div class="mb-0">
                <select class="form-select form-control " name='country' id="country"  >
                    <option class="" value="" disabled selected hidden>Select Country</option>    
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{ old('country') == $country->id ? 'selected' : '' }}>{{$country->country_name}}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>
        
         <!-- submit-->
         <div class="input-group">
        <input class="form-control btn btn-dark btn-outline-warning " type="button" id="next" value="Next">
         </div>
</div>


    <!-- FlightDetails -->
    <div class="row " style="display:none" id='FlightDiv'>

        <!-- departure date -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Departure Date</label>           
            <div class="input-group">
            <input type="text" class="form-control" id='departure_date' name="departure_date" onfocus="(this.type='date')" placeholder="Select Departure date" value="{{ old('departure_date') }}" >
            </div>    
        </div>

        <!-- return date -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Return Date</label>           
            <div class="input-group">
            <input type="text" class="form-control" id="return_date" name='return_date' onfocus="(this.type='date')" placeholder="Enter Return Date" value="{{ old('return_date') }}"  >
            </div>
        </div>

        <!-- Departure city -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Departure City</label>
            <input type="text" class="form-control" id="departure_city" name='departure_city' placeholder="Enter City " value="{{old('departure_city')}}">
        </div>

        <!-- Departure country -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Departure Country</label>
            <select class="form-select form-control " id="departure_country"  name="departure_country" >
                <option value="" disabled selected hidden>Select Departure Country</option>       
                @foreach($countries as $country)
                <option value="{{$country->id}}" {{ old('departure_country') == $country->id ? 'selected' : '' }}>{{$country->country_name}}</option>
                @endforeach
            </select>    
        </div>

        <!-- Destination city -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Destination City</label>
            <input type="text" class="form-control" id="destination_city" name='destination_city' placeholder="Enter Destination city " value="{{old('destination_city')}}">
        </div>

         <!-- Destination country -->
        <div class="mb-3">
            <label class="form-label d-flex align-items-start">Destination Country</label>
            <select class="form-select form-control " id="destination_country"   name="destination_country" >
                <option value="" disabled selected hidden>Select Departure Country</option>    
                @foreach($countries as $country)
                <option value="{{$country->id}}" {{ old('destination_country') == $country->id ? 'selected' : '' }}>{{$country->country_name}}</option>
                @endforeach
            </select>
        </div>
         
        <!-- Booking Class -->
        <div class="row" id="">
            <div class="col mb-3 " id="BCError">
                <label class="form-label d-flex align-items-start">Booking Class</label>
                    <div class="form-check " style="display:none; ">
                    <input class="form-check-input BC" type="radio" id="booking_class"  name="booking_class" value="" disable>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">First Class</label>
                    </div>
                    <div class="form-check ">
                    <input class="form-check-input BC" type="radio" id="booking_class"  name="booking_class" value="First Class" {{ old('booking_class') == "First Class" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">First Class</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input BC" type="radio" id="booking_class"  name="booking_class" value="Business Class" {{ old('booking_class') == "Business Class" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Business Class</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input BC" type="radio" id="booking_class"  name="booking_class" value="Premium Economy" {{ old('booking_class') == "Premium Economy" ? ' checked' : '' }} >
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Premium Economy</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input BC" type="radio" id="booking_class"  name="booking_class" value="Economy Class" {{ old('booking_class') == "Economy Class" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Economy Class</label>
                    </div>                
            </div>

            <!-- Ticket Type -->
            <div class="col mb-3 " id="TTError">
                <label class="form-label d-flex align-items-start" >Ticket Type</label>
                     <div class="form-check" style="display:none;">
                    <input class="form-check-input TT" type="radio" id="ticket_type" name="ticket_type" value="" disable>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">One Way</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input TT" type="radio" id="ticket_type" name="ticket_type" value="One Way" {{ old('ticket_type') == "One Ways" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">One Way</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input TT" type="radio" id="ticket_type" name="ticket_type" value="Round Trip" {{ old('ticket_type') == "Round Trip" ? ' checked' : '' }} >
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Round Trip</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input TT" type="radio" id="ticket_type" name="ticket_type" value="Coach Ticket" {{ old('ticket_type') == "Coach Ticket" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Coach Ticket</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input TT" type="radio" id="ticket_type" name="ticket_type" value="Refundable Ticket" {{ old('ticket_type') == "Refundable Ticket" ? ' checked' : '' }}>
                    <label class="form-check-label d-flex align-items-start ms-1" for="flexCheckChecked">Refundable Ticket</label>    
                    </div> 
            </div>
        
            <!-- Id proof-->
            <div class="mb-3">
            <label for="formFile" class="form-label d-flex align-items-start" >Upload ID Proof</label>
            <input class="form-control form-control-sm" id="id_proof" name='id_proof' type="file" >
            </div>

            <!-- submit-->
            <div class="input-group">
            <input  class="form-control btn btn-dark btn-outline-warning " type="submit" id="submit" value="Submit"  >
            </div>
            <input href="#myModal" data-bs-toggle="modal" class="form-control btn btn-dark btn-outline-warning " type="button" id="submitmodal" value="Submit" style="display:none;">
            </div>
        </div>
    </form>
    </div>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade " tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content  mx-auto bg-dark text-secondary">
            <div class="modal-header p-2 modalHF" >
                <h5 class="modal-title">Thank you!!</h5>
            </div>
            <img src="{{url('/images/ty.png')}}" class="mt-0 mx-auto " style=" height:14em; " ></img>
            <div class="modal-body my-1 px-4 pb-2 pt-1">
                <p>Dear Dolly Rebello, Congratulations! Your flight are reserved succesfully.</p>
            </div>
            <span class="modal-body my-1 px-4 pb-2 pt-1"> Below are your flight details:</span>
            <div class="row g-3 mx-75 mt-0 mb-0 px-4">
                <div class="col-md-6 ">
                    <label>Departure Date: <span id='d1' class="text-warning"></span></label>
                </div>
                <div class="col-md-6 ">
                    <label>Return Date: <span id='d2' class="text-warning"></span></label>
                </div>
            </div>
            <div class="row g-3 mx-75 mt-0 mb-0 px-4">
                <div class="col-md-6 ">
                    <label>Departure City: <span id='d3' class="text-warning"></span></label>
                </div>
                <div class="col-md-6 ">
                    <label>Departure Country: <span id='d4' class="text-warning"></span></label>
                </div>
            </div>
            <div class="row g-3 mx-75 mt-0 mb-0 px-4">
                <div class="col-md-6 ">
                    <label>Destination City: <span id='d5' class="text-warning"></span></label>
                </div>  
                <div class="col-md-6 ">
                    <label>Destination Country: <span id='d6' class="text-warning"></span></label>
                </div>
            </div>
            <div class="row g-3 mx-75 mt-0 mb-2 px-4">
                <div class="col-md-6 ">
                    <label>Booking Class: <span id='d7' class="text-warning"></span></label>
                </div>
                <div class="col-md-6 ">
                    <label>Ticket Type: <span id='d8' class="text-warning"></span></label>
                </div>
            </div>
            <div class="modal-footer p-1  modalHF">
                <button type="button" class="btn btn-secondary p-1 w-25 bg-dark text-secondary" data-bs-dismiss="modal" style="font-size:12px;">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

