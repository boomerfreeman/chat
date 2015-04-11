<?php

// Show every chatroom message:
$query = "SELECT username, message "
       . "FROM users, messages "
       . "WHERE users.user_id = messages.user_id "
       . "ORDER BY time";

$stmt = $dbh->query($query);

?>
<!-- Print chatroom page: -->
    <body id="body-chat">
        <script src="js/checkmsg.js"></script>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-default">

                    <?php
                    // Print all chatroom data:
                    while ($row = $stmt->fetch()) {
                        echo "<h5><strong>{$row['username']}: </strong> {$row['message']}</h5>";
                    }
                    ?>

                        <div id="show"></div>
                    </div>
                    <form method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">                                    
                                    <input type="text" class="form-control" id="message" placeholder="Message...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" id="button">Send message</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
