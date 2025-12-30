<?php
use app\widgets\VoyageCard; ?>

<div class="grid md:grid-cols-3 gap-8">
    <?php if($voyages != null && count($voyages) != 0) :?>
        <?php foreach($voyages as $voyage): ?>
            <?= VoyageCard::widget([
                'voyage' => $voyage,
                'nbpersonnes' => $nbpersonnes,
            ]) ?>
        <?php endforeach ?>
    <?php else: ?>
        <p>Aucun voyage trouvé pour ce trajet.</p>
    <?php endif; ?>
</div>
