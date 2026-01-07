<?php

/** @var yii\web\View $this */
/** @var app\models\TypeVehicule[] $typesVehicules */
/** @var app\models\MarqueVehicule[] $marquesVehicules */
/** @var app\models\Trajet[] $trajets */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Proposer un voyage - CERICar";
?>

<div class="site-proposer-voyage">
    <div class="pt-32 pb-20 bg-yellow-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6">

            <!-- En-tête -->
            <div class="text-center mb-12">
                <h1 class="text-6xl font-black mb-4 transform -rotate-2 inline-block">
                    Proposer un <span class="bg-green-400 px-4 border-2 border-black">VOYAGE</span>
                </h1>
                <p class="text-xl font-bold text-gray-600">Partagez les frais et faites des rencontres !</p>
            </div>

            <!-- Formulaire -->
            <?= Html::beginForm(['site/proposer-voyage-submit'], 'post', [
                'id' => 'form-proposer-voyage',
                'class' => 'space-y-8',
                'data-ajax-url' => Url::to(['site/proposer-voyage-submit']),
            ]) ?>

                <!-- Section 1: Trajet -->
                <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                    <h2 class="text-3xl font-black mb-6 flex items-center gap-3">
                        <i data-lucide="map-pin" class="w-8 h-8"></i>
                        Trajet
                    </h2>

                    <div class="space-y-4">
                        <div class="relative">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Recherchez votre trajet <span class="text-red-600">*</span>
                            </label>
                            <input type="text"
                                   id="trajet-search"
                                   autocomplete="off"
                                   required
                                   class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   placeholder="Ex: Avignon → Paris">
                            <input type="hidden" name="trajet" id="trajet-id" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Heure de départ <span class="text-red-600">*</span>
                            </label>
                            <select name="heureDepart" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">-- Choisissez l'heure --</option>
                                <?php for ($h = 0; $h < 24; $h++): ?>
                                    <option value="<?= $h ?>"><?= sprintf('%02d', $h) ?>h00</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Détails du voyage -->
                <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform rotate-1">
                    <h2 class="text-3xl font-black mb-6 flex items-center gap-3">
                        <i data-lucide="settings" class="w-8 h-8"></i>
                        Détails du voyage
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Nombre de places disponibles <span class="text-red-600">*</span>
                            </label>
                            <input type="number" name="nbPlacesDispo" min="1" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Ex: 3">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Tarif par km (€) <span class="text-red-600">*</span>
                            </label>
                            <input type="number" name="tarif" min="0.01" step="0.01" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Ex: 0.20">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Bagages autorisés par personne <span class="text-red-600">*</span>
                            </label>
                            <input type="number" name="nbBagage" min="0" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Ex: 1">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Véhicule -->
                <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                    <h2 class="text-3xl font-black mb-6 flex items-center gap-3">
                        <i data-lucide="car" class="w-8 h-8"></i>
                        Véhicule
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Type de véhicule <span class="text-red-600">*</span>
                            </label>
                            <select name="typeVehicule" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">-- Sélectionnez --</option>
                                <?php foreach ($typesVehicules as $type): ?>
                                    <option value="<?= $type->id ?>"><?= Html::encode($type->typev) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Marque du véhicule <span class="text-red-600">*</span>
                            </label>
                            <select name="marqueVehicule" required class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">-- Sélectionnez --</option>
                                <?php foreach ($marquesVehicules as $marque): ?>
                                    <option value="<?= $marque->id ?>"><?= Html::encode($marque->marquev) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Informations supplémentaires -->
                <div class="bg-white border-4 border-black rounded-3xl p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform rotate-1">
                    <h2 class="text-3xl font-black mb-6 flex items-center gap-3">
                        <i data-lucide="info" class="w-8 h-8"></i>
                        Informations supplémentaires
                    </h2>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Contraintes ou préférences (optionnel)
                        </label>
                        <textarea name="contraintes" rows="4" maxlength="500" class="w-full border-2 border-black rounded-lg p-4 font-medium text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Ex: Pas d'animaux, Musique bienvenue, Arrêts autorisés..."></textarea>
                        <p class="text-xs text-gray-500 mt-1">Maximum 500 caractères</p>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex gap-4">
                    <a href="<?= Url::to(['site/mapage']) ?>" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-black text-xl py-5 px-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all text-center">
                        Annuler
                    </a>
                    <button type="submit" class="flex-1 bg-green-400 hover:bg-green-500 text-black font-black text-xl py-5 px-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all transform -rotate-1 hover:rotate-0">
                        <div class="flex items-center justify-center gap-2">
                            <i data-lucide="send" class="w-6 h-6"></i>
                            <span>Proposer ce voyage</span>
                        </div>
                    </button>
                </div>

            <?= Html::endForm() ?>

        </div>
    </div>

    <!-- Liste de suggestions (hors du formulaire pour éviter les conflits de z-index) -->
    <div id="trajet-suggestions" class="hidden fixed z-[9999] bg-white border-4 border-black rounded-lg shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] max-h-80 overflow-y-auto">
        <?php foreach ($trajets as $trajet): ?>
            <div class="trajet-option p-4 hover:bg-purple-100 cursor-pointer border-b-2 border-gray-200 last:border-b-0 font-bold transition-colors"
                 data-id="<?= $trajet->id ?>"
                 data-text="<?= Html::encode($trajet->depart) ?> → <?= Html::encode($trajet->arrivee) ?> (<?= $trajet->distance ?> km)"
                 data-search="<?= strtolower(Html::encode($trajet->depart . ' ' . $trajet->arrivee)) ?>">
                <div class="flex items-center gap-2">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    <?= Html::encode($trajet->depart) ?> → <?= Html::encode($trajet->arrivee) ?>
                    <span class="ml-auto text-sm bg-blue-100 px-2 py-1 rounded border border-black"><?= $trajet->distance ?> km</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$this->registerJs("
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

// Autocomplétion du trajet
const trajetSearch = document.getElementById('trajet-search');
const trajetId = document.getElementById('trajet-id');
const suggestions = document.getElementById('trajet-suggestions');
const options = document.querySelectorAll('.trajet-option');

// Fonction pour positionner les suggestions
function positionSuggestions() {
    const rect = trajetSearch.getBoundingClientRect();
    suggestions.style.top = (rect.bottom + 8) + 'px';
    suggestions.style.left = rect.left + 'px';
    suggestions.style.width = rect.width + 'px';
}

// Afficher les suggestions au focus
trajetSearch.addEventListener('focus', function() {
    positionSuggestions();
    filterSuggestions();
    suggestions.classList.remove('hidden');
});

// Filtrer au fur et à mesure de la saisie
trajetSearch.addEventListener('input', function() {
    filterSuggestions();
});

// Repositionner au scroll et au resize
window.addEventListener('scroll', function() {
    if (!suggestions.classList.contains('hidden')) {
        positionSuggestions();
    }
});

window.addEventListener('resize', function() {
    if (!suggestions.classList.contains('hidden')) {
        positionSuggestions();
    }
});

// Fonction de filtrage
function filterSuggestions() {
    const searchTerm = trajetSearch.value.toLowerCase();
    let hasVisibleOptions = false;

    options.forEach(function(option) {
        const searchData = option.getAttribute('data-search');

        if (searchTerm === '' || searchData.includes(searchTerm)) {
            option.style.display = 'block';
            hasVisibleOptions = true;
        } else {
            option.style.display = 'none';
        }
    });

    // Afficher ou cacher la liste selon s'il y a des résultats
    if (hasVisibleOptions) {
        suggestions.classList.remove('hidden');
    } else {
        suggestions.classList.add('hidden');
    }
}

// Sélectionner une option
options.forEach(function(option) {
    option.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const text = this.getAttribute('data-text');

        trajetSearch.value = text;
        trajetId.value = id;
        suggestions.classList.add('hidden');
    });
});

// Fermer les suggestions quand on clique ailleurs
document.addEventListener('click', function(e) {
    if (!e.target.closest('#trajet-search') && !e.target.closest('#trajet-suggestions')) {
        suggestions.classList.add('hidden');
    }
});

// Soumettre le formulaire avec jQuery
$('#form-proposer-voyage').on('submit', function(e) {
    e.preventDefault();

    const formData = $(this).serialize();

    $.ajax({
        url: $(this).data('ajax-url'),
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(response) {
            if (response.success) {
                showSuccess(response.message);
                setTimeout(() => {
                    window.location.href = '" . Url::to(['site/index']) . "';
                }, 1500);
            } else {
                showError(response.message);
            }
        },
        error: function(xhr, status, error) {
            showError('Impossible de créer le voyage. Veuillez réessayer.');
        }
    });
});
", \yii\web\View::POS_READY);
?>
