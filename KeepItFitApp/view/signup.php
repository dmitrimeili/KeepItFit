<?php
/*
 * Author : Dmitri Meili
 * Date : 28.02.2022
 * Project : PreTpi
 */
ob_start();
$title = "signup";

?>
    <div class="container wrapper style1 centered">
        <div class="row justify-content-center">


            <div id="logo-container"></div>
            <div class="col-sm-12 col-md-10 col-md-offset-1 w-25 p-3 ">
                <form action="index.php?action=CreateAccount" method="post" id="signupForm">
                    <div class="form-group ">
                        <input class="form-control" type="text" name='firstname' placeholder="prénom"/>
                    </div>
                    <br>
                    <div class="form-group ">
                        <input class="form-control" type="text" name='lastname' placeholder="nom"/>
                    </div>
                    <br>
                    <div class="form-group ">
                        <input class="form-control" type="email" name='email' placeholder="email"/>
                    </div>
                    <br>
                    <div class="form-group  ">
                        <input class="form-control" type="password" name='password' placeholder="mot de passe"/>
                    </div>
                    <br>
                    <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                        <input placeholder="Select date" type="date" id="example" class="form-control" name="birthday">

                    </div>
                    <br>
                    <div >
                        <input class="form-control"  type="number" name="weight">
                    </div>
                    <br>
                    <div >
                        <input class="form-control"  type="number" name="height">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Créer le compte">
                    </div>
                    <div class="form-group text-center">
                        <a href="index.php?action=Login">Login</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>