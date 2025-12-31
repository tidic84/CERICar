$(document).ready(function () {
    $("#permisCheckbox").on("change", function () {
        const $container = $("#permis-numero-container");
        const $input = $("#numeroPermis");

        if ($(this).is(":checked")) {
            $container.removeClass("hidden").addClass("animate-fadeIn");
            $input.attr("required", true);
            if (typeof lucide !== "undefined") {
                lucide.createIcons();
            }
        } else {
            $container.addClass("hidden");
            $input.attr("required", false);
            $input.val("");
        }
    });

    $("#register-form").on("submit", function (e) {
        e.preventDefault();

        var formData = {
            prenom: $('input[name="prenom"]').val(),
            nom: $('input[name="nom"]').val(),
            pseudo: $('input[name="pseudo"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
            passwordConfirm: $('input[name="passwordConfirm"]').val(),
            permis: $("#permisCheckbox").is(":checked") ? 1 : 0,
            photo: $('input[name="photo"]').val(),
            numeroPermis: $('input[name="numeroPermis"]').val(),
            cgu: $("#cgu").is(":checked") ? 1 : 0,
        };

        // console.log(formData);

        $.ajax({
            url: $("#register-form").data("ajax-url"),
            type: "GET",
            dataType: "json",
            data: formData,
            success: function (response) {
                if (response.success) {
                    showSuccess(response.message);
                    setTimeout(function () {
                        window.location.href = response.redirect || "/";
                    }, 1500);
                } else {
                    showError(response.message);
                }
            },
            error: function (xhr, status, error) {
                showError(error);
            },
        });
    });
});
