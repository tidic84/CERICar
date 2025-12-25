<?php

use app\models\Trajet;
use app\models\Voyage;
use app\models\Internaute;
use app\models\Reservation;

/** @var yii\web\View $this */

$this->title = "Ma Page";
$this->params["breadcrumbs"][] = $this->title;
?>
<div class="site-mapage">
    <div class="body-content">
        <h2> Test </h2>
        <p> <?php echo $test; ?> </p>
        <h2>Informations de l'internaute : <?= $internaute->pseudo ?></h2>
          <p>Nom: <?= $internaute->nom ?></p>
          <p>Email: <?= $internaute->mail ?></p>
          <p>Permis: <?= $internaute->permis ?? "Non renseigné" ?></p>

          <?php if ($voyagesProposes && count($voyagesProposes) > 0): ?>
              <h3>Voyages proposés:</h3>
              <?php foreach ($voyagesProposes as $voyage): ?>
                  <p><?= $voyage ?></p> <!-- utilise __toString() avec relations -->
              <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($reservations && count($reservations) > 0): ?>
              <h3>Réservations:</h3>
              <?php foreach ($reservations as $reservation): ?>
                  <p><?= $reservation->voyageObj ?></p> <!-- affiche le voyage via la relation -->
              <?php endforeach; ?>
          <?php endif; ?>
    </div>
</div>
