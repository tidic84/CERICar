$(document).ready(function () {
    console.log("Script logout.js chargé !");

    $("#logout-form, #logout-form-mobile").on("submit", function (e) {
        e.preventDefault();

        console.log("Déconnexion en cours...");

        var ajaxUrl = $(this).data("ajax-url");
        console.log("URL Ajax:", ajaxUrl);

        $.ajax({
            url: ajaxUrl,
            type: "POST",
            dataType: "json",
            data: {
                _csrf: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log("Réponse:", response);

                if (response.success) {
                    showSuccess(response.message);

                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 1500);
                } else {
                    showError(response.message || "Erreur lors de la déconnexion");
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur:", error);
                showError("Impossible de se déconnecter. Veuillez réessayer.");
            },
        });
    });
});
