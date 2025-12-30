<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Voyage;
use yii\web\View;

$this->registerJs("
    (function($) {
        $('#rechercheVoyages').on('submit', function(e) {
            e.preventDefault();

            // Récupérer seulement les champs nécessaires (sans le paramètre 'r')
            var formData = {
                depart: $('input[name=\"depart\"]').val(),
                arrivee: $('input[name=\"arrivee\"]').val(),
                nbpersonnes: $('select[name=\"nbpersonnes\"]').val()
            };

            console.log('Formulaire soumis');
            console.log('URL:', '" . Url::to(['site/recherche-voyages']) . "');
            console.log('Data:', formData);

            $.ajax({
                url: '" . Url::to(['site/recherche-voyages']) . "',
                type: 'GET',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    console.log('Succès! Réponse:', response);
                    if (response.success) {
                        var html = '';

                        if (response.voyages.length > 0) {
                            response.voyages.forEach(function(voyage) {
                                // Déterminer la couleur selon les places restantes
                                var bgColor = 'bg-green-300';
                                if (voyage.placesRestantes == 1) {
                                    bgColor = 'bg-orange-300';
                                } else if (voyage.placesRestantes < 1) {
                                    bgColor = 'bg-red-300';
                                }

                                // Construire le HTML de la carte
                                html += '<div class=\"bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group\">';
                                html += '  <div class=\"h-40 rounded-xl border-2 border-black bg-pink-300 mb-4 relative overflow-hidden flex items-center justify-center\">';
                                html += '    <img src=\"' + voyage.arriveeImg + '\">';
                                html += '  </div>';
                                html += '  <div class=\"flex justify-between items-start mb-4\">';
                                html += '    <div>';
                                html += '      <div class=\"font-bold text-lg flex items-center gap-2\">';
                                html += '        ' + voyage.depart;
                                html += '        <i data-lucide=\"arrow-right\"></i>';
                                html += '        ' + voyage.arrivee;
                                html += '      </div>';
                                html += '      <div class=\"text-sm font-medium text-gray-500\">Demain, ' + voyage.heureDepart + '</div>';
                                html += '    </div>';
                                html += '    <div class=\"bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2\">';
                                html += '      ' + voyage.prix + '€';
                                html += '    </div>';
                                html += '  </div>';
                                html += '  <div class=\"mt-auto flex items-center justify-between border-t-2 border-gray-100 pt-3\">';
                                html += '    <div class=\"flex items-center gap-3\">';
                                html += '      <img src=\"' + voyage.conducteurPhoto + '\" class=\"w-10 h-10 rounded-full border-2 border-black bg-gray-200\">';
                                html += '      <div class=\"text-sm\">';
                                html += '        <div class=\"font-bold\">' + voyage.conducteurNom + '</div>';
                                html += '        <div class=\"flex items-center text-xs font-bold text-yellow-500\">';
                                html += '          <i class=\"w-3 h-3 fill-current\" data-lucide=\"star\"></i>';
                                html += '          5.0';
                                html += '        </div>';
                                html += '      </div>';
                                html += '    </div>';
                                html += '    <div class=\"flex items-center gap-1.5 ' + bgColor + ' border-2 border-black px-2 py-1 rounded-lg text-xs font-black uppercase tracking-wide transform -rotate-2\">';
                                html += '      <i class=\"w-3 h-3 fill-current\" data-lucide=\"user\"></i>';
                                html += '      <span>' + voyage.placesRestantes + '/' + voyage.nbPlacesDispo + ' Places</span>';
                                html += '    </div>';
                                html += '  </div>';
                                html += '</div>';
                            });
                        } else {
                            html = '<p class=\"col-span-3 text-center text-gray-600 font-bold\">Aucun voyage trouvé pour ce trajet.</p>';
                        }

                        $('#section-resultats').removeClass('hidden');
                        $('#resultats').html(html);
                        lucide.createIcons();
                    } else {
                        $('#section-resultats').removeClass('hidden');
                        $('#resultats').html('<p class=\"col-span-3 text-center text-red-600 font-bold\">' + response.message + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erreur complète:', xhr);
                    console.log('Status:', status);
                    console.log('Erreur:', error);
                    console.log('Réponse texte:', xhr.responseText);
                    $('#section-resultats').removeClass('hidden');
                    $('#resultats').html('<p class=\"col-span-3 text-center text-red-600 font-bold\">Erreur: ' + error + '<br>Voir console pour détails</p>');
                }
            });
        });
    })(jQuery);
", View::POS_READY);

$this->title = "CERICar - Accueil";
?>

<div class="site-index">

    <!-- Section Barre de recherche -->
    <div class="pt-32 pb-20 bg-yellow-50 min-h-screen flex flex-col items-center relative overflow-hidden">
        <!-- Background patterns -->
        <img class="absolute top-20 left-1/4 w-40 rotate-45" src="images/polygon-3d.svg"></img>
        <img class="absolute top-80 left-40 w-60" src="images/circle-shadow.svg"></img>
        <img class="absolute top-10 right-1/4 w-40" src="images/rombos-shadow.svg"></img>
        <img class="absolute top-60 right-60 w-40" src="images/rombo-shadow.svg"></img>
        <img class="absolute bottom-40 right-10" src="images/circle-3d.svg"></img>
        <img class="absolute -bottom-20 left-1/4" src="images/cube-3d.svg"></img>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <div class="inline-block mb-6 transform rotate-2">
                    <span class="bg-orange-400 text-white px-3 py-1 rounded-full border-2 border-black text-xs font-black uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        Nouveau !
                    </span>
                </div>
                <h1 class="text-6xl md:text-8xl font-black leading-[0.9] mb-8 tracking-tight">
                    VOYAGEZ<br/>
                    <span class="text-purple-600 bg-white px-4 border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 inline-block mx-2 pb-3">MIEUX</span>
                    ET<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-orange-600">ENSEMBLE.</span>
                </h1>
                <p class="text-xl font-bold text-gray-700 max-w-2xl mx-auto">
                    Le covoiturage qui a du peps. Économisez de l'argent, rencontrez des gens sympas et sauvez la planète, le tout avec le sourire.
                </p>
            </div>

            <!-- Search Box "Ticket" -->
            <div class="bg-white border-2 border-black rounded-3xl p-6 md:p-8 max-w-5xl mx-auto shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex">
                <?= Html::beginForm(["index"], "get", [
                    "id" => "rechercheVoyages",
                    "class" => "grid md:grid-cols-4 gap-6",
                ]) ?>
                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Départ
                        </label>
                        <?= Html::textInput("depart", "$depart", [
                            "placeholder" => "Ex: Paris",
                            "class" =>
                                "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors",
                        ]) ?>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Arrivée
                        </label>
                        <?= Html::textInput("arrivee", "$arrivee", [
                            "placeholder" => "Ex: Toulouse",
                            "class" =>
                                "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors",
                        ]) ?>
                    </div>

                    <div class="gap-4">
                        <div class="space-y-2">
                            <label class="font-black text-sm uppercase flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Pers.
                            </label>
                            <?= Html::dropDownList(
                                "nbpersonnes",
                                $nbpersonnes,
                                [
                                    1 => "1",
                                    2 => "2",
                                    3 => "3",
                                    4 => "4",
                                    5 => "5",
                                ],
                                [
                                    "class" =>
                                        "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-2 py-3 font-bold outline-none",
                                ],
                            ) ?>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full font-bold border-2 border-black rounded-xl px-6 py-3 bg-yellow-400 text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-yellow-300 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-2 h-[52px] text-lg">
                            <i data-lucide="search"></i>
                            C'est parti !
                        </button>
                    </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
    <!-- Section Trajets -->
    <section id="section-resultats" class="hidden py-20 bg-white border-t-2 border-black">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <h2 class="text-4xl font-black uppercase italic">
                    Les trajets qui te <span class="text-purple-600 bg-yellow-300 px-2">correspondent</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8" id="resultats">
            </div>

        </div>
    </section>

    <!-- Section Avis -->
    <section class="py-20 bg-purple-600 border-y-2 border-black">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div class="text-white space-y-6">
                <span class="bg-yellow-400 text-black px-3 py-1 rounded-full border-2 border-black text-xs font-black uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] inline-block">
                    Vibe Check
                </span>
                <h2 class="text-5xl font-black leading-tight">
                    PAS JUSTE UN TRAJET,<br/>UNE EXPERIENCE.
                </h2>
                <p class="text-xl font-medium opacity-90">
                    Choisissez votre ambiance. Plutôt discussion animée, playlist karaoké ou silence zen ? Avec CERICar, vous savez à quoi vous attendre avant de monter.
                </p>
            </div>

            <div class="relative">
                <!-- Illustration Abstract Card -->
                <div class="bg-white border-2 border-black rounded-[2.5rem] p-8 shadow-[16px_16px_0px_0px_rgba(0,0,0,1)] rotate-2 hover:rotate-0 transition-transform duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-full bg-gray-200 border-2 border-black overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=a042581f4e29026024d" alt="User" />
                        </div>
                        <div>
                            <div class="font-black text-xl">Nicolas D.</div>
                            <div class="text-purple-600 font-bold">Conducteur Confirmé</div>
                        </div>
                        <img src="images/App-Store-Logo.png" class="w-20 ml-auto"></img>
                    </div>
                    <p class="text-2xl font-bold leading-relaxed">
                        "J'adore prendre des passagers pour aller en festival ! La route passe super vite et on partage nos meilleures playlists."
                    </p>
                    <div class="mt-6 flex justify-between items-end">
                        <div class="text-sm font-bold text-gray-400">Il y a 2 heures</div>
                        <div class="flex text-yellow-500">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="w-6 h-6 fill-current" data-lucide="star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

    </script>
</div>
