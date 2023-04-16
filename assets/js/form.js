/** ----------- Event Listeners ----------- */

$("#login_form").submit(function(e) {
    e.preventDefault();
});
$("#submitForm").submit(function(e) {
    e.preventDefault();
});


/** ----------- Functions ----------- */

function manage_button(activate = false, id_button_submit) {
    // Controls a button (locked/unlocked)
    if (activate) {
        $(id_button_submit).removeClass("disabled");
    } else {
        $(id_button_submit).addClass("disabled");
    }
}

function checkEmail(id, button) {
    // Check if nick is duplicated in DB
    var email = $(id).val();
    $.ajax({
        url: "database/fetch.php",
        method: "GET",
        data: {
            check_email: true,
            email: email
        },
        // If email is valid
        success: function (result) {
            $("#duplicateEmail_error").removeClass("show").addClass("hidden");
            console.log('Email is valid');
        },
        error: function () {
            $(id).addClass("error").removeClass("success");
            $("#duplicateEmail_error").addClass("show").removeClass("hidden");
            checkErrors(button);
        }
    })
}

function checkErrors(button, require_valid = false, required_fields = 0) {
    // Check for the number of wrong fields in form
    var number_of_errors = $('.error').length;
    // Adds the number of elements with warning
    number_of_errors += $('.running').length;
    // Counts the number of elements that contain the success class
    var number_of_valid = $('.success').length;

    if (require_valid) {
        if (number_of_valid != required_fields) {
            manage_button(false, button);
            return false;
        }
    }
    // Only allows form submission if the amount if errors is zero and all required fields are correct
    if (number_of_errors == 0) {
        manage_button(true, button);
        return true;
    } else {
        manage_button(false, button);
        return false;
    }
}

function failed_submit(id, error_message = "Email or password are incorrect.") {
    // Function sets HTML for when form submit has failed
    setTimeout(function () {
        $(id).html(`
        <h3>Error!</h3>
        <h6>${error_message}</h6>
        <div class="f-modal-icon f-modal-error animate">
            <span class="f-modal-x-mark">
                <span class="f-modal-line f-modal-left animateXLeft"></span>
                <span class="f-modal-line f-modal-right animateXRight"></span>
            </span>
            <div class="f-modal-placeholder"></div>
            <div class="f-modal-fix"></div>
        </div>
        </br>
        <hr>
        `)
    }, 700);
}

function validateEmail(id, button) {
    // Validate a given email
    var email = $(id).val();
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let isEmailValid = regex.test(email);
    // Check if email is valid and apply classes
    if (isEmailValid) {
        $(id).removeClass("error").addClass("success");
        $("#email_error").removeClass("show").addClass("hidden");
        // check if email is duplicated in DB
        checkEmail(id, button);
    } else {
        $(id).removeClass("success").addClass("error");
        $("#email_error").removeClass("hidden").addClass("show");
    }
    
    // Check for successfull validations
    checkErrors(button);
}

function validateName(id, button, IsCheckbox = false, required_fields = 2) {

    function hasSpecialchar(string) {
        // Function to test is the given nick has special char
        var specialChar = /[`~!@#$%^&*()_|+\-=?;:..’“'"<>,€£¥•،٫؟»«\{\}\[\]\\\/]+/gi;
        return specialChar.test(string);
    }
    
    function hasSpace(string, id) {
        // Function to test is the given nick has spaces
        var spaceArray = [" "];

        jQuery.each(spaceArray, function (i, space) {

            if (string.includes(space)) {
                $(id).removeClass("success").addClass("error");
                $("#name_error").removeClass("hidden").addClass("show");
                return true;
            }
        });
        return false;
    }
    function rangeNickname(string) {
        if (string.length < 2 || string.length > 20) {
            $(id).removeClass("success").addClass("error");
            $("#name_error").removeClass("hidden").addClass("show");
            return true;
        }
    }
    var nick = $(id).val();
    // Test for special char in nickname
    if (hasSpecialchar(nick)) {
        // error
        $(id).removeClass("success").addClass("error");
        $("#name_error").removeClass("hidden").addClass("show");
    } else {
        // success
        $(id).removeClass("error").addClass("success");
        $("#name_error").removeClass("show").addClass("hidden");
    }
    // Check for empty nickname
    if (nick == "") {
        $(id).removeClass("error").removeClass("success");
        $("#name_error").removeClass("show").addClass("hidden");

        if (!IsCheckbox) {
            manage_button(false, button);
        } else {
            checkErrors(button);
        }
        return

    }
    // Validation for name
    hasSpace(nick, id);
    rangeNickname(nick);
    // Check for successfull validations
    manage_button(true, button);
    if (!IsCheckbox) {
        checkErrors(button, true, required_fields, true);
    } else {
        checkErrors(button);
    }
}

function validateDate(id, button) {
    // Validate a given date, date has to be in format: YYYY-MM-DD
    var value = $(id).val();
    var year = value.charAt(4);
    // Check if year is bigger than 9999 by checking the string in 4th position and analysing if its a number 
    // (wrong date ex.: bigger than 9999) or a separation symbol (correct date ex.: less than 10000)
    if (value == '' || year != '-') {
        $(id).removeClass("success").removeClass("error");
        $("#birthdate_error").addClass("hidden").removeClass("show");
        manage_button(false, button);
        return;
    }
    // with the date validated, instanciate new objects 'Date'
    var birthDate = new Date(value);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    // check if age is higher than the minimun required (10)
    if (age < 10 || age > 100) {
        $(id).removeClass("success").addClass("error");
        $("#birthdate_error").removeClass("hidden").addClass("show");
    } else {
        $(id).removeClass("error").addClass("success");
        $("#birthdate_error").removeClass("show").addClass("hidden");
    }
    // Final validations
    checkErrors(button, true, 2);
}


function ShowHideOnClick(id, elementIdToHideOrShow) {
    // Function to show or hide element when checkbox is checked
    var show = $(id).is(':checked') ? 1 : 0;

    if(show == 1) {
        $(elementIdToHideOrShow).removeClass("hidden").addClass("show");
    } else {
        $(elementIdToHideOrShow).removeClass("show").addClass("hidden");
    }
}

function Redirect(page) {
    // Redirect to homepage
    $(location).attr('href', page);
}

/** ----------- Functions END ----------- */

$('#submit_login').click(function () {
    // Get variables from form and submit it
    var email = $('#email').val();
    var pwd = $('#pwd').val();

    // AJAX Post sending data
    $.ajax({
        url: "database/post.php",
        method: "POST",
        data: {
            Login: true,
            email: email,
            pw: pwd,
        },
        success: function (result) {
            console.log(result);
            $(location).attr('href','reserved.php')
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            failed_submit('#result');
        }
    })
});
