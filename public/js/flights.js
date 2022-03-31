// Call to validate form fields
$(document).ready(function () {
    $("#next").click(function () {
        $("#formData").valid();
    });
    $("#submit").click(function () {
        $("#formData").valid();
    });
});

// Restricting user to check only one checkbox
$(document).ready(function () {
    $(".TT").click(function () {
        $(".TT").not(this).prop("checked", false);
    });
});

$(document).ready(function () {
    $(".BC").click(function () {
        $(".BC").not(this).prop("checked", false);
    });
});

// Switch between form and buttons(active)
$(document).ready(function () {
    $("#next").click(function () {
        if (
            !$(
                "#salutation,#first_name,#last_name,#date_of_birth,#email,#phone_number,#address,#city,#state,#zip_code,#country"
            ).hasClass("error")
        ) {
            $(".change1").attr("checked", true);
            $(".change2").attr("checked", false);
            $("#PersonDiv").slideUp("slow");
            $("#FlightDiv").slideDown("slow");
            $("#SError").remove();
        }
    });

    $(".change1").click(function () {
        $(".change1").attr("checked", true);
        $(".change2").attr("checked", false);
        $("#PersonDiv").slideUp("slow");
        $("#FlightDiv").slideDown("slow");
        $("#SError").remove();
    });

    $(".change2").click(function () {
        $(".change2").attr("checked", true);
        $(".change1").attr("checked", false);
        $("#FlightDiv").slideUp("slow");
        $("#PersonDiv").slideDown("slow");
        $("#SError").remove();
    });
});
