<?php
$class = "no-sidebar";
ob_start();

?>
<div class="container wrapper style1 centered">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-md-offset-1 w-25 p-3 ">
            <form id="createExForm" action="index.php?action=createEx" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <input type="text" name="name" placeholder="Nom"><br>
                <select name="program">
                    <?php foreach ($programs as $program) { ?>
                        <option value="<?= $program['id'] ?>"><?= $program['name'] ?></option>
                    <?php } ?>
                </select><br>
                <textarea name="description"></textarea><br>
                <input type="number" name="reps" placeholder="Répétition" min="0"><br>
                <input type="number" name="time" placeholder="temps en seconde" min="0"><br>
                <input type="number" max="3" placeholder="difficulté" name="difficulty" min="1"><br>
                <select name="material">
                    <?php foreach ($materials as $material) { ?>
                        <option value="<?= $material['id'] ?>"><?= $material['name'] ?></option>
                    <?php } ?>
                </select><br>
                <select name="area">
                    <?php foreach ($areas as $area) { ?>
                        <option value="<?= $area['id'] ?>"><?= $area['name'] ?></option>
                    <?php } ?>
                </select><br>
                <input type="submit" id="submit" name="submit" value="Créer l'exercice">

            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>
