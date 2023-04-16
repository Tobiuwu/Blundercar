; (function ($) {
    "use strict";

    //* Form js
    function verificationForm() {
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function () {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function () {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

    };

    /*Function Calls*/
    verificationForm();
})(jQuery);

$('#submit_form').click(function () {
    // Get variables from form and submit it
    var name = $('#nick').val();
    var birthdate = $('#birthdate').val();
    var is_client = $('#is_client').is(':checked') ? 1 : 0;
    var message = $('#message').val();
    // Fail the form submit if user is not swimmer
    if (is_client == 1) {
        var email = $('#email').val();
    }
    // prepare discord message and send
    var content = `Your message was successfully sent! \n
        Name: ${name},\n
        Birthdate: ${birthdate},\n
        IsClient: ${is_client},\n
        ClientEmail: ${email},\n
        Message: ${message}
    `;
    SendDiscordAlert(content, name, birthdate, is_client, email, message);
});

function SendDiscordAlert(content, name, birthdate, is_client, email, message) {
    // Send AJAX request to get discord webhook link from db
    $.ajax({
        url: "database/fetch.php",
        method: "GET",
        data: {
            getWebhook: true,
            id: 1
        },
        success: function (result) {
            // on success send post to webhook link with the new registered user data
            webhookArray = JSON.parse(result);
            $.post(webhookArray["webhookLink"], {"content": content})
            .done(function(data) {
                successMessage();
            })
            .fail(function (data) {
                failed_submit("#result", "Something went wrong, please try again later!");
            });
        },
        error: function () {
            // failed to send notification
            console.log("Failed to retrieve webhook link");
            
        }
      })
}

function successMessage(){
    setTimeout(function () {
        // Success
        $('#result').html(`
        <h3>Success!</h3>
        <div class="success-checkmark">
        <div class="check-icon">
            <span class="icon-line line-tip"></span>
            <span class="icon-line line-long"></span>
            <div class="icon-circle"></div>
            <div class="icon-fix"></div>
        </div>
        </div>
        </br>
        <hr>
        <button type="button" class="action-button previous_button return_homepage" onclick="Redirect('index.html')">Finish</button> 
        `);
    }, 700); 
}