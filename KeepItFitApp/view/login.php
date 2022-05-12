<?php
ob_start();
$title = "Login";
$class = "no-sidebar";
?>
<div class="container wrapper style1 centered">
    <div class="row justify-content-center">

            <div id="logo-container"></div>
            <div class="col-sm-12 col-md-10 col-md-offset-1 w-25 p-3 " >
                <form action="index.php?action=tryLogin" id="loginForm" method="post">
                    <br>
                    <div>

                        <input class="form-control" type="text" name='email' placeholder="Email"/>
                    </div>
                    <br>
                    <div>

                        <input class="form-control" type="password" name='password' placeholder="Password"/>
                    </div>
                    <br>
                    <div>
                        <input type="submit" id="submit" value="Login">
                    </div>
                    <div class="form-group text-center">
                        <a href="index.php?action=Signup">Create an account</a>
                    </div>
                </form>

        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
