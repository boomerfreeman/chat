$(document).ready(function() {
    
    // If the file with selectors is included:
    if ($("#username").length && $("#password").length) {
        
        // Bind fields when document is ready:
        $("#username, #password").change(function() {
            var user = $("#username");
            var pass = $("#password");

            var user_regexp = /^[а-яa-z0-9_.-]{2,20}$/i;
            var pass_regexp = /^[а-яa-z0-9_.-]{3,}$/i;

            // If regular expressions accept inputs, show messages:
            if (user_regexp.test(user.val())) {
                user.removeClass("error").addClass("noError");
                user.next(".input-group-addon").text("Correct").css("color", "green");
            // Otherwise show other message:
            } else {
                user.removeClass("noError").addClass("error");
                user.next(".input-group-addon").text("Bad username").css("color", "red");
            }

            if (pass_regexp.test(pass.val())) {
                pass.removeClass("error").addClass("noError");
                pass.next(".input-group-addon").text("Correct").css("color", "green");
            } else {
                pass.removeClass("noError").addClass("error");
                pass.next(".input-group-addon").text("Wrong password").css("color", "red");
            }
        });

        // If inputs have no errors then send script:
        $("form").submit(function(event) {
            if ($(".noError").length === 2) {
                $("form").unbind("submit").submit(event);
            } else {
                // Or stop the script, till inputs are correct:
                event.preventDefault();
            }
        });
    }
});