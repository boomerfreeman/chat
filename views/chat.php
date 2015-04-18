<!-- Print chatroom page: -->
    <body id="body-chat">
        <div class="container">
            <form name="formout" action="./index.php" method="POST">
                <input type="submit" name="logout" value="Log out" class="btn btn-default" id="logout">
            </form>
            <h5 id="hi">Welcome to chatroom, <?=$_SESSION['username'];?>!</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="show"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><strong><?=$_SESSION['username'].':';?></strong></span>
                        <input type="text" class="form-control" id="message" placeholder="Message...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="send">Send message</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </body>
