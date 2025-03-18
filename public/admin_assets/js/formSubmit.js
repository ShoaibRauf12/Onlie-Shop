function formSubmit(formId, route, method) {
    $(formId).on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $(formId + " .error").remove();
        $(formId + " .is-invalid").removeClass("is-invalid");

        $.ajax({
            url: route,
            method: method,
            data: formData,
            success: function (response) {
                if (response.status === true) {
                    window.location.href = response.redirect_url;
                } else if (response.status === false) {
                    var errors = response.errors;
                    $.each(errors, function (fieldName, messages) {
                        var field = $(formId + ' [name="' + fieldName + '"]');
                        field.after(
                            '<span class="error text-danger">' +
                                messages[0] +
                                "</span>"
                        );
                        field.addClass("is-invalid");
                    });
                }
            },
            error: function (xhr, status, error) {
                alert("Koi galti hui hai: " + error);
            },
        });
    });
}

function nameSlug(targetId, route, method) {
    
    $(targetId).on("change", function () {
        var slug = $(this);
        $.ajax({
            url: route,
            type: method,
            data: {
                title: slug.val(),
            },
            dataType: "json",
            success: function (response) {
                if (response.success == true) {
                    $("#slug").val(response.slug);
                }
            },
        });
    });
}
