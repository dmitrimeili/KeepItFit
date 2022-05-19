<?php
ob_start();
$class = "no-sidebar";
?>
<div class="container wrapper style1 centered">
    <div class="row">
        <div class="col-sm">
            <a href="index.php?action=CreateExPage" class="centered">
                <button>Créer un exercice</button>
            </a>
        </div>
        <div class="col-sm">
            <a href="index.php?action=allExPage" class="centered">
                <button>Voir tout les exercice</button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <form action="index.php?action=addPlace" id="placeForm" method="post">
                <input class="form-control" type="text" name="place" placeholder="Ajouter un lieu"><br>
                <input type="submit" id="submit" value="Ajouter">
            </form>
            <hr>
            <h3>Lieu existant</h3>
            <br>
            Cliquez pour supprimer<br><br>
            <?php foreach ($places as $place) { ?>
                <form action="index.php?action=delPlace" method="post">
                    <input type="submit" value="<?= $place['place'] ?>" name="delplace">
                </form><br>
            <?php } ?>
        </div>
        <div class="col-sm">
            <form action="index.php?action=addMaterial" id="materialForm" method="post">
                <input class="form-control" type="text" name="material" placeholder="Ajouter matériel"><br>
                <input type="submit" id="submit" value="Ajouter">
            </form>
            <hr>
            <h3>Matériel existant</h3>
            <br>
            Cliquez pour supprimer<br><br>
            <?php foreach ($materials as $material) { ?>
                <form action="index.php?action=delMaterial" method="post">
                    <input type="submit" value="<?= $material['name'] ?>" name="delmaterial">
                </form><br>
            <?php } ?>
        </div>
        <div class="col-sm">
            <form action="index.php?action=addTargetedArea" id="targetedAreaForm" method="post">
                <input class="form-control" type="text" name="trargetedArea" placeholder="Ajouter une zone ciblé"><br>
                <input type="submit" id="submit" value="Ajouter">
            </form>
            <hr>
            <h3>Zone ciblée existantes</h3>
            <br>
            Cliquez pour supprimer<br><br>
            <?php foreach ($areas as $area) { ?>
                <form action="index.php?action=delArea" method="post">
                    <input type="submit" value="<?= $area['name'] ?>" name="delarea">
                </form><br>
            <?php } ?>
        </div>
        <div class="col-sm">
            <form action="index.php?action=addProgram" id="programForm" method="post">
                <input class="form-control" type="text" name="program" placeholder="Ajouter un programme"><br>
                <input type="submit" id="submit" value="Ajouter">
            </form>
            <hr>
            <h3>Programmes existant</h3>
            <br>
            Cliquez pour supprimer<br><br>
            <?php foreach ($programs as $program) { ?>
                <form action="index.php?action=delProgram" method="post">
                    <input type="submit" value="<?= $program['name'] ?>" name="delprogram">
                </form><br>
            <?php } ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
