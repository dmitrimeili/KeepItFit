<?php
/*
 * Author : Dmitri Meili
 * Date : 28.02.2022
 * Project : PreTpi
 */
ob_start();
$title = "signup";
$class = "no-sidebar";

?>
    <div class="container wrapper style1 centered">
        <div class="row justify-content-center">


            <div id="logo-container"></div>
            <div class="col-sm-12 col-md-10 col-md-offset-1 w-25 p-3 ">
                <form action="index.php?action=CreateAccount" method="post" id="signupForm">
                    <div>
                        <input class="form-control" type="text" name='firstname' placeholder="prénom"/>
                    </div>
                    <br>
                    <div>
                        <input class="form-control" type="text" name='lastname' placeholder="nom"/>
                    </div>
                    <br>
                    <div>
                        <input class="form-control" type="email" name='email' placeholder="email"/>
                    </div>
                    <br>
                    <div>
                        <input class="form-control" type="password" name='password' placeholder="mot de passe"/>
                    </div>
                    <br>
                    <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                         Date de naissance : <input placeholder="Select date" type="date" id="example" class="form-control" name="birthday" max="2005-01-01" min="1972-01-01">

                    </div>
                    <br>
                    <div >
                        Poids : <input class="form-control"  type="number" name="weight" min="35" max="200">
                    </div>
                    <br>
                    <div >
                        Taille en cm : <input class="form-control"  type="number" name="height" min="100" max="230">
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