$(function () {
    //check if age is abv 18 custom validation
    $.validator.addMethod(
        "minAge",
        function (value, element, min) {
            var today = new Date();
            var birthDate = new Date(value);
            var age = today.getFullYear() - birthDate.getFullYear();

            if (age > min + 1) {
                return true;
            }

            var m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age >= min;
        },
        "You are not old enough!"
    );

    $("form[name='PersonAndFlightData']").validate({
        // Specify validation rules
        rules: {
            // Person Data
            salutation: "required",
            first_name: "required",
            date_of_birth: { required: true, minAge: 18 },
            email: { required: true, email: true },
            phone_number: "required",
            address: "required",
            city: "required",
            state: "required",
            zip_code: "required",
            country: "required",

            //Flight Data
            departure_date: "required",
            return_date: "required",
            departure_city: "required",
            departure_country: "required",
            destination_city: "required",
            destination_country: "required",
            booking_class: "required",
            ticket_type: "required",
            id_proof: "required",
        },
        // Specify validation error messages
        messages: {
            salutation: "Salution is required",
            first_name: "First name required",
            date_of_birth: {
                required: "Date of Birth is required",
                minAge: "The age should be above 18 years",
            },
            phone_number: "Number is required",
            email: {
                required: "Email is required",
                email: "Please enter a valid email address",
            },
            address: "Please enter Addres",
            city: "This field is required",
            state: "State is required",
            zip_code: "Zip code is required",
            country: "Select Nationality",
            departure_date: "Departure date is required",
            return_date: "Return date is required",
            departure_city: "Please enter Departure City ",
            departure_country: "Departure country is required",
            destination_city: "Destination city is required",
            destination_country: "Destination country is required",
            booking_class: "Class is required",
            ticket_type: "Ticket type is required",
            id_proof: "Identity Prof  is required",
        },
        errorPlacement: function (error, element) {
            // Place erorrs of radio buttons
            if (element.attr("id") == "booking_class") {
                error.appendTo("#BCError");
            } else if (element.attr("id") == "ticket_type") {
                error.appendTo("#TTError");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            // Sending data
            var Fdata = new FormData(form);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "POST",
                url: "/flights/store",
                data: Fdata,
                cache: false,
                contentType: false,
                processData: false,
            })
                .done(function (data) {
                    // Show modal with confirmation msg
                    $("#myModal").modal("show");

                    // Send data on modal
                    $("label").children("#d1").html(data.departure_date);
                    $("label").children("#d2").html(data.return_date);

                    $("label").children("#d3").html(data.departure_city);
                    $("label")
                        .children("#d4")
                        .html(data.departure_country.country_name);

                    $("label").children("#d5").html(data.destination_city);
                    $("label")
                        .children("#d6")
                        .html(data.destination_country.country_name);

                    $("label").children("#d7").html(data.booking_class);
                    $("label").children("#d8").html(data.ticket_type);

                    // Show Personal Details page and reset
                    $(".change2").attr("checked", true);
                    $(".change1").attr("checked", false);
                    $("#FlightDiv").slideUp("slow");
                    $("#PersonDiv").slideDown("slow");
                    document.getElementById("formData").reset();
                    document.getElementById("departure_date").type = "text";
                    document.getElementById("return_date").type = "text";
                    document.getElementById("date_of_birth").type = "text";
                    $("input").removeClass("valid");
                    $("select").removeClass("valid");

                    // Enable submit button
                    $("#submit").prop("disabled", false);
                })
                .fail(function (data) {
                    
                    // Show server side validation error
                    $errors = data.responseJSON;
                    var errorString = "<div>";
                    var response = JSON.parse(data.responseText);
                    if (response.errors) {
                        // Show try catch error
                        errorString += "<li>" + response.errors[0].message + "</li>";
                        
                    } else {
                        // Show backend validation errror
                        $.each($errors, function (key, value) {
                            errorString += "<li>" + value[0] + "</li>";
                        }); 
                    }

                    errorString += "</div>";
                    toastr.error(errorString);

                    // Enable submit button
                    $("#submit").prop("disabled", false);
                });
        },
    });
});
