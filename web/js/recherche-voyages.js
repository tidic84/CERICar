$(document).ready(function () {
    $("#rechercheVoyages").on("submit", function (e) {
        e.preventDefault();

        var formData = {
            depart: $('input[name="depart"]').val(),
            arrivee: $('input[name="arrivee"]').val(),
            nbpersonnes: $('select[name="nbpersonnes"]').val(),
        };


        $.ajax({
            url: $("#rechercheVoyages").data("ajax-url"),
            type: "GET",
            dataType: "json",
            data: formData,
            success: function (response) {

                if (response.success) {
                    afficherVoyages(response.voyages, formData);
                    showInfo(response.message);
                } else {
                    afficherErreur(response.message);
                    showError(response.message);
                }
            },
            error: function (xhr, status, error) {
                afficherErreur("Erreur lors de la recherche");
                showError("Impossible de charger les voyages. Veuillez réessayer.");
            },
        });
    });
});

function afficherVoyages(voyages, formData) {
    let html = "";

    if (voyages.length > 0) {
        html = voyages.map(voyage => voyageCard(voyage)).join("");
    } else {
        html = `<p class="col-span-3 text-center text-gray-600 font-bold">Aucun voyage trouvé pour ce trajet.</p>`;
    }

    $("#section-resultats").removeClass("hidden");
    $("#resultats").html(html);

    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }

    $("html, body").animate({
        scrollTop: $("#section-resultats").offset().top - 50
    }, 800, "swing");

}

function voyageCard(voyage) {
    let bgColor = "bg-green-300";
    if (voyage.placesRestantes == 1) {
        bgColor = "bg-orange-300";
    } else if (voyage.placesRestantes < 1) {
        bgColor = "bg-red-300";
    }

    return `
        <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group">
            <div class="h-40 rounded-xl border-2 border-black bg-pink-300 mb-4 relative overflow-hidden flex items-center justify-center">
                <img src="${voyage.arriveeImg}">
            </div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <div class="font-bold text-lg flex items-center gap-2">
                        ${voyage.depart}
                        <i data-lucide="arrow-right"></i>
                        ${voyage.arrivee}
                    </div>
                    <div class="text-sm font-medium text-gray-500">Demain, ${voyage.heureDepart}</div>
                </div>
                <div class="bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2">
                    ${voyage.prix}€
                </div>
            </div>
            <div class="mt-auto flex items-center justify-between border-t-2 border-gray-100 pt-3">
                <div class="flex items-center gap-3">
                    <img src="${voyage.conducteurPhoto}" class="w-10 h-10 rounded-full border-2 border-black bg-gray-200">
                    <div class="text-sm">
                        <div class="font-bold">${voyage.conducteurNom}</div>
                        <div class="flex items-center text-xs font-bold text-yellow-500">
                            <i class="w-3 h-3 fill-current" data-lucide="star"></i>
                            5.0
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 ${bgColor} border-2 border-black px-2 py-1 rounded-lg text-xs font-black uppercase tracking-wide transform -rotate-2">
                    <i class="w-3 h-3 fill-current" data-lucide="user"></i>
                    <span>${voyage.placesRestantes}/${voyage.nbPlacesDispo} Places</span>
                </div>
            </div>
        </div>
    `;
}

function afficherErreur(message) {
    $("#section-resultats").removeClass("hidden");
    $("#resultats").html(`
        <p class="col-span-3 text-center text-red-600 font-bold">${message}</p>
    `);
}
