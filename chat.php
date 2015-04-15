<!-- Print chatroom page: -->
    <body id="body-chat">
        <div class="container">
            <a href="./logout.php" class="btn btn-default" id="logout">Log out</a>
            <h5 id="hi">Welcome to chatroom, <?=$_SESSION['username'];?>!</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="show"></div>
                </div>
            </div>
            <form method="POST" class="form-horizontal">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><strong><?=$_SESSION['username'].':';?></strong></span>
                            <input type="text" class="form-control" id="message" placeholder="Message...">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" id="send">Send message</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
