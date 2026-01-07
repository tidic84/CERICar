<?php

/** @var yii\web\View $this */
/** @var app\models\Internaute $internaute */
/** @var app\models\Voyage[]|null $voyagesProposes */
/** @var app\models\Reservation[] $reservations */

use yii\helpers\Html;

$this->title = "Mon Profil - CERICar";
?>

<div class="site-profile">
    <div class="pt-32 pb-20 bg-yellow-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-6">

            <!-- En-tête du profil -->
            <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] mb-8 transform -rotate-1">
                <div class="flex items-center gap-6">
                    <img src="<?= $internaute->getProfilePicture() ?>" alt="<?= Html::encode($internaute->prenom) ?>" class="w-32 h-32 rounded-full border-4 border-black bg-gray-200">
                    <div class="flex-1">
                        <h1 class="text-5xl font-black mb-2"><?= Html::encode($internaute->prenom . ' ' . $internaute->nom) ?></h1>
                        <p class="text-xl font-bold text-gray-600">@<?= Html::encode($internaute->pseudo) ?></p>
                        <div class="flex items-center gap-2 mt-3">
                            <div class="bg-purple-600 text-white px-4 py-2 rounded-lg border-2 border-black font-black text-sm transform rotate-2">
                                <i data-lucide="star" class="w-4 h-4 inline fill-current"></i>
                                5.0
                            </div>
                            <?php if ($internaute->permis): ?>
                                <div class="bg-green-400 text-black px-4 py-2 rounded-lg border-2 border-black font-black text-sm transform -rotate-2">
                                    <i data-lucide="badge-check" class="w-4 h-4 inline"></i>
                                    Conducteur vérifié
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations personnelles -->
            <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] mb-8">
                <h2 class="text-3xl font-black mb-6 transform -rotate-1">
                    <i data-lucide="user" class="w-8 h-8 inline"></i>
                    Informations personnelles
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="border-2 border-black rounded-xl p-5 bg-blue-100 transform -rotate-1">
                        <div class="text-sm font-bold text-gray-600 mb-2">EMAIL</div>
                        <div class="font-black text-lg"><?= Html::encode($internaute->mail) ?></div>
                    </div>

                    <div class="border-2 border-black rounded-xl p-5 bg-yellow-100 transform rotate-1">
                        <div class="text-sm font-bold text-gray-600 mb-2">PERMIS DE CONDUIRE</div>
                        <div class="font-black text-lg">
                            <?php if ($internaute->permis): ?>
                                <i data-lucide="check-circle" class="w-5 h-5 inline text-green-600"></i>
                                <?= Html::encode($internaute->permis) ?>
                            <?php else: ?>
                                <i data-lucide="x-circle" class="w-5 h-5 inline text-red-600"></i>
                                Non renseigné
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mes réservations -->
            <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] mb-8 transform rotate-1">
                <h2 class="text-3xl font-black mb-6">
                    <i data-lucide="calendar-check" class="w-8 h-8 inline"></i>
                    Mes réservations
                </h2>

                <?php if ($reservations && count($reservations) > 0): ?>
                    <div class="grid gap-4">
                        <?php foreach ($reservations as $reservation): ?>
                            <?php $voyage = $reservation->voyageObj; ?>
                            <div class="border-2 border-black rounded-xl p-5 bg-purple-50 hover:bg-purple-100 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="font-black text-xl">
                                                <?= Html::encode($voyage->trajetObj->depart) ?>
                                                <i data-lucide="arrow-right" class="w-5 h-5 inline"></i>
                                                <?= Html::encode($voyage->trajetObj->arrivee) ?>
                                            </div>
                                        </div>
                                        <div class="text-sm font-medium text-gray-600 mb-3">
                                            Demain, <?= $voyage->getFormatHeureDeDepart() ?>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-2">
                                                <img src="<?= $voyage->conducteurObj->getProfilePicture() ?>" class="w-8 h-8 rounded-full border-2 border-black">
                                                <span class="font-bold text-sm"><?= Html::encode($voyage->conducteurObj) ?></span>
                                            </div>
                                            <div class="bg-blue-300 border-2 border-black px-3 py-1 rounded-lg text-xs font-black uppercase">
                                                <i data-lucide="users" class="w-3 h-3 inline"></i>
                                                <?= $reservation->nbplaceresa ?> place<?= $reservation->nbplaceresa > 1 ? 's' : '' ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-black text-white px-4 py-2 rounded-lg font-black text-xl transform rotate-2">
                                        <?= $voyage->getPrix($reservation->nbplaceresa) ?>€
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12 border-2 border-dashed border-gray-300 rounded-xl">
                        <i data-lucide="inbox" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                        <p class="text-xl font-bold text-gray-500">Aucune réservation pour le moment</p>
                        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="inline-block mt-4 bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-3 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
                            Rechercher un voyage
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Voyages proposés (si conducteur) -->
            <?php if ($voyagesProposes !== null): ?>
                <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                    <h2 class="text-3xl font-black mb-6">
                        <i data-lucide="car-front" class="w-8 h-8 inline"></i>
                        Mes voyages proposés
                    </h2>

                    <?php if (count($voyagesProposes) > 0): ?>
                        <div class="grid gap-4">
                            <?php foreach ($voyagesProposes as $voyage): ?>
                                <div class="border-2 border-black rounded-xl p-5 bg-green-50 hover:bg-green-100 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <div class="font-black text-xl">
                                                    <?= Html::encode($voyage->trajetObj->depart) ?>
                                                    <i data-lucide="arrow-right" class="w-5 h-5 inline"></i>
                                                    <?= Html::encode($voyage->trajetObj->arrivee) ?>
                                                </div>
                                            </div>
                                            <div class="text-sm font-medium text-gray-600 mb-3">
                                                Demain, <?= $voyage->getFormatHeureDeDepart() ?>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <div class="bg-orange-300 border-2 border-black px-3 py-1 rounded-lg text-xs font-black uppercase">
                                                    <i data-lucide="user" class="w-3 h-3 inline"></i>
                                                    <?= $voyage->getPlacesRestantes() ?>/<?= $voyage->nbplacedispo ?> places restantes
                                                </div>
                                                <div class="bg-yellow-300 border-2 border-black px-3 py-1 rounded-lg text-xs font-black uppercase">
                                                    <i data-lucide="users" class="w-3 h-3 inline"></i>
                                                    <?= count($voyage->reservations) ?> réservation<?= count($voyage->reservations) > 1 ? 's' : '' ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-black text-white px-4 py-2 rounded-lg font-black text-xl transform rotate-2">
                                            <?= $voyage->getPrix(1) ?>€
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12 border-2 border-dashed border-gray-300 rounded-xl">
                            <i data-lucide="car" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                            <p class="text-xl font-bold text-gray-500">Aucun voyage proposé</p>
                            <p class="text-sm text-gray-400 mt-2">Proposez un voyage et partagez les frais !</p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}
</script>
