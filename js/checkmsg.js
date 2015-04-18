$(document).ready(function() {

    // When user clicks on button with id=send
    $("#send").click(function() {
        
        var msg = $("#message");
        
        // If length of typed message is > 0 and < 1000:
        if (msg.val().length > 0 && msg.val().length < 1000) {
            msg.removeClass("error").addClass("noError");
            // Change button skin:
            $("#send").removeClass("btn-default").addClass("btn-success").fadeOut(500, function () {
                $("#send").removeClass("btn-success").addClass("btn-default").fadeIn(250);
            });
            
            // And send AJAX request to chat_ajax.php:
            $.ajax({
                url: "controllers/chat_ajax.php",
                type: "POST",
                data: "message=" + msg.val(),
                
                // If success, show received data and clear input field:
                success: function(data) {
                    $("#show").append(data);
                    msg.val("");
                }
            });
            
        } else {
            // Change button skin if value is wrong:
            msg.removeClass("noError").addClass("error");
            $("#send").removeClass("btn-default").addClass("btn-danger").fadeOut(500, function () {
                $("#send").removeClass("btn-danger").addClass("btn-default").fadeIn(250);
            });
        }
    });
});
