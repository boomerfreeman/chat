<!-- Print login page: -->
    <body id="body-login">
        <div class="container">
            <form action="./index.php" method="POST" class="form-signin">
                <h2 class="form-signin-heading">Log in or register:</h2>
                <div class="input-group">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    <span class="input-group-addon" id="basic-addon1"></span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <span class="input-group-addon" id="basic-addon2"></span>
                </div>
                <input type="submit" name="login" value="Login" class="btn btn-info">
                <input type="submit" name="register" value="Register" class="btn btn-danger">
            </form>
        </div>
    </body>
