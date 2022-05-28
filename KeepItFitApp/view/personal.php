<?php
ob_start();
$class = "no-sidebar";
?>

<div class="container wrapper style1 centered">

    <form action="index.php?action=CreateProgram" method="post">
        <div class="row ">
            <div class="col-sm">
                <select name="place">
                    <?php foreach ($places as $place) { ?>
                        <option value="<?= $place['id'] ?>"><?= $place['place'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm">
                <select name="program">
                    <?php foreach ($programs as $program) { ?>
                        <option value="<?= $program['id'] ?>"><?= $program['name'] ?></option>
                    <?php } ?>
                </select>
                <br>
            </div>
            <input type="submit" id="submit" name="submit" value="Créer un programme perso">
        </div>
        <form>
<br>
            <h1>Vos programmes</h1>

            <?php foreach ($persoprogs as $persoprog) {?>
                <div class="rounded w3-hover-shadow"><br>
                    <header class="w3-container "><h2> Type : <?= $persoprog["name"] ?><br></h2></header>
                    <div class="right w3-container">
                        <a href="index.php?action=PersonalProgramPage&progId=<?= $persoprog['program_id'] ?>">
                            <button type="button" style="width: 35%">Détails</button>
                        </a>
                    </div>
                    <br>
                    <br>
                </div>
            <?php } ?>
</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
