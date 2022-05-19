<?php
ob_start();
$class = "no-sidebar";
?>

<?= $exercise['exercise']?>
<?php
$content = ob_get_clean();
require_once "gabarit.php";
?>

