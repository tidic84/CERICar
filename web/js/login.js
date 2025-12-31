$(document).ready(function () {
    $("#login-form").on("submit", function (e) {
        e.preventDefault();

        var formData = {
            identifiant: $('input[name="identifiant"]').val(),
            password: $('input[name="password"]').val(),
            remember: $('#remember').is(':checked') ? 1 : 0,
        };

        console.log("Connexion...", formData);

        $.ajax({
            url: $("#login-form").data("ajax-url"),
            type: "GET",
            dataType: "json",
            data: formData,
            success: function (response) {
                console.log("Réponse:", response);

                if (response.success) {
                    showSuccess(response.message);

                    setTimeout(function() {
                        window.location.href = response.redirect || '/';
                    }, 1500);
                } else {
                    showError(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur:", error);
                showError("Impossible de se connecter. Veuillez réessayer.");
            },
        });
    });
});
