<?php

use app\models\Trajet;
use app\models\Voyage;
use app\models\Internaute;

/** @var yii\web\View $this */

$this->title = "Ma Page";
$this->params["breadcrumbs"][] = $this->title;
?>
<div class="site-mapage">
    <div class="body-content">
        <div class="jumbotron text-center bg-transparent mt-5 mb-5">
            <?php echo "<p>" . $internautes[0] . "</p>"; ?>
            <?php echo "<p>" . $marqueVehicules[0] . "</p>"; ?>
            <?php echo "<p>" . $reservations[0]->id . "</p>"; ?>
            <?php echo "<p>" . $trajets[0] . "</p>"; ?>
            <?php echo "<p>" . $typeVehicules[0] . "</p>"; ?>
            <?php echo "<p>" . $voyages[0] . "</p>"; ?>
            <?php echo "<p>" . $getTrajet . "</p>"; ?>
            <?php echo "<p>" . Voyage::arrayToString($getVoyages) . "</p>"; ?>
            <?php echo "<p>" . $getInternaute . "</p"; ?>
        </div>
    </div>
</div>
