function openVoyageModal(voyageId) {
    if (!window.isUserLoggedIn) {
        showWarning("Connectez-vous pour réserver un voyage");
        return;
    }

    $.ajax({
        url: window.urlGetVoyageDetails || '/site/get-voyage-details',
        type: 'GET',
        dataType: 'json',
        data: { id: voyageId },
        success: function(response) {
            if (response.success) {
                afficherModalVoyage(response.voyage);
            } else {
                showError(response.message);
            }
        },
        error: function(xhr, status, error) {
            showError("Impossible de charger les détails du voyage");
        }
    });
}

function afficherModalVoyage(voyage) {
    let bgColor = "bg-green-300";
    if (voyage.placesRestantes == 1) {
        bgColor = "bg-orange-300";
    } else if (voyage.placesRestantes < 1) {
        bgColor = "bg-red-300";
    }

    const nbPassagersOptions = Array.from({length: voyage.placesRestantes}, (_, i) => i + 1)
        .map(n => `<option value="${n}">${n} passager${n > 1 ? 's' : ''}</option>`)
        .join('');

    const modalHTML = `
        <div id="voyage-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 pt-20 bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="bg-white border-4 border-black rounded-3xl max-w-3xl w-full shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform scale-95 modal-enter max-h-[90vh] overflow-y-auto">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-8">
                        <h2 class="text-4xl font-black transform -rotate-1">Détails du voyage</h2>
                        <button onclick="closeVoyageModal()" class="w-12 h-12 rounded-full border-2 border-black bg-red-300 hover:bg-red-400 flex items-center justify-center transform rotate-12 hover:rotate-0 transition-transform">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>

                    <div class="h-64 rounded-2xl border-4 border-black bg-pink-300 mb-8 overflow-hidden flex items-center justify-center">
                        <img src="${voyage.arriveeImg}" alt="${voyage.arrivee}" class="w-full h-full object-cover">
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div class="border-2 border-black rounded-xl p-5 bg-blue-100 transform -rotate-1">
                            <div class="text-sm font-bold text-gray-600 mb-2">TRAJET</div>
                            <div class="font-black text-xl flex items-center gap-2">
                                ${voyage.depart}
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                ${voyage.arrivee}
                            </div>
                            <div class="text-sm font-medium text-gray-500 mt-2">Demain, ${voyage.heureDepart}</div>
                        </div>

                        <div class="border-2 border-black rounded-xl p-5 bg-yellow-100 transform rotate-1">
                            <div class="text-sm font-bold text-gray-600 mb-2">PRIX PAR PERSONNE</div>
                            <div class="font-black text-3xl">${voyage.prixUnitaire}€</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div class="border-2 border-black rounded-xl p-5 bg-green-100 transform rotate-1">
                            <div class="text-sm font-bold text-gray-600 mb-2">DISTANCE</div>
                            <div class="font-black text-2xl flex items-center gap-2">
                                <i data-lucide="route" class="w-6 h-6"></i>
                                ${voyage.distance} km
                            </div>
                        </div>

                        <div class="border-2 border-black rounded-xl p-5 bg-orange-100 transform -rotate-1">
                            <div class="text-sm font-bold text-gray-600 mb-2">BAGAGES AUTORISÉS</div>
                            <div class="font-black text-2xl flex items-center gap-2">
                                <i data-lucide="baggage-claim" class="w-6 h-6"></i>
                                ${voyage.nbBagage} / personne
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-black rounded-xl p-5 bg-purple-100 mb-6 transform -rotate-1">
                        <div class="text-sm font-bold text-gray-600 mb-3">CONDUCTEUR</div>
                        <div class="flex items-center gap-4">
                            <img src="${voyage.conducteurPhoto}" class="w-16 h-16 rounded-full border-2 border-black bg-gray-200">
                            <div>
                                <div class="font-black text-xl">${voyage.conducteurNom}</div>
                                <div class="flex items-center text-sm font-bold text-yellow-500 mt-1">
                                    <i class="w-4 h-4 fill-current" data-lucide="star"></i>
                                    <span class="ml-1">5.0 (${voyage.nbVoyages} voyages)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-black rounded-xl p-5 bg-pink-100 mb-6 transform rotate-1">
                        <div class="text-sm font-bold text-gray-600 mb-3">VÉHICULE</div>
                        <div class="flex items-center gap-3">
                            <i data-lucide="car" class="w-8 h-8"></i>
                            <div>
                                <div class="font-black text-lg">${voyage.marqueVehicule}</div>
                                <div class="text-sm font-medium text-gray-600">${voyage.typeVehicule}</div>
                            </div>
                        </div>
                    </div>

                    ${voyage.contraintes ? `
                        <div class="border-2 border-black rounded-xl p-5 bg-yellow-50 mb-6 transform -rotate-1">
                            <div class="text-sm font-bold text-gray-600 mb-3">INFORMATIONS SUPPLÉMENTAIRES</div>
                            <div class="text-sm font-medium text-gray-700 leading-relaxed">
                                ${voyage.contraintes}
                            </div>
                        </div>
                    ` : ''}

                    <div class="border-2 border-black rounded-xl p-5 bg-green-100 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-bold text-gray-600">PLACES DISPONIBLES</div>
                            <div class="flex items-center gap-2 ${bgColor} border-2 border-black px-3 py-1 rounded-lg text-sm font-black uppercase tracking-wide transform -rotate-2">
                                <i class="w-4 h-4 fill-current" data-lucide="user"></i>
                                <span>${voyage.placesRestantes}/${voyage.nbPlacesDispo}</span>
                            </div>
                        </div>
                    </div>

                    ${voyage.placesRestantes > 0 ? `
                        <div class="border-t-4 border-black pt-8 mt-2">
                            <h3 class="text-2xl font-black mb-6 transform -rotate-1">Réservation</h3>

                            <div class="mb-6">
                                <label class="block text-sm font-bold text-gray-700 mb-3">Nombre de passagers</label>
                                <select id="nb-passagers" class="w-full border-2 border-black rounded-lg p-4 font-bold text-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    ${nbPassagersOptions}
                                </select>
                            </div>

                            <div id="prix-total" class="bg-yellow-200 border-2 border-black rounded-lg p-5 mb-6 transform rotate-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-lg text-gray-700">Prix total</span>
                                    <span class="font-black text-3xl">${voyage.prixUnitaire}€</span>
                                </div>
                            </div>

                            <button onclick="reserverVoyage(${voyage.id})" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-black text-xl py-5 px-6 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all transform -rotate-1 hover:rotate-0">
                                <div class="flex items-center justify-center gap-2">
                                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                                    <span>Réserver ce voyage</span>
                                </div>
                            </button>
                        </div>
                    ` : `
                        <div class="bg-red-100 border-2 border-black rounded-lg p-5 text-center">
                            <div class="font-black text-lg text-red-600">Ce voyage est complet</div>
                        </div>
                    `}
                </div>
            </div>
        </div>
    `;

    $('#voyage-modal-container').html(modalHTML);

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    setTimeout(() => {
        $('#voyage-modal').removeClass('scale-95').addClass('scale-100');
    }, 10);

    $('#nb-passagers').on('change', function() {
        const nbPassagers = parseInt($(this).val());
        const prixTotal = nbPassagers * voyage.prixUnitaire;
        $('#prix-total span:last-child').text(prixTotal + '€');
    });

    $('body').css('overflow', 'hidden');
}

function closeVoyageModal() {
    $('#voyage-modal').removeClass('scale-100').addClass('scale-95');
    setTimeout(() => {
        $('#voyage-modal-container').html('');
        $('body').css('overflow', 'auto');
    }, 200);
}

function reserverVoyage(voyageId) {
    const nbPassagers = parseInt($('#nb-passagers').val()) || 1;

    // Récupérer le token CSRF de Yii
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const csrfParam = $('meta[name="csrf-param"]').attr('content');

    const data = {
        voyageId: voyageId,
        nbPassagers: nbPassagers
    };

    if (csrfParam && csrfToken) {
        data[csrfParam] = csrfToken;
    }

    $.ajax({
        url: window.urlReserver || '/site/reserver',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
            if (response.success) {
                showSuccess(response.message);
                closeVoyageModal();

                if (typeof afficherVoyages === 'function' && response.voyages) {
                    setTimeout(() => {
                        afficherVoyages(response.voyages, {});
                    }, 500);
                }
            } else {
                showError(response.message);
            }
        },
        error: function(xhr, status, error) {
            showError("Impossible de réserver le voyage. Veuillez réessayer.");
        }
    });
}

// Event listeners pour le modal
$(document).ready(function() {
    $(document).on('click', '#voyage-modal', function(e) {
        if (e.target.id === 'voyage-modal') {
            closeVoyageModal();
        }
    });

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#voyage-modal').length > 0) {
            closeVoyageModal();
        }
    });
});
