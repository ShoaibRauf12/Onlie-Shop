
function formSubmit(formId, route, method) {
    $(formId).on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize(); 

        $.ajax({
            url: route,  
            method: method,   
            data: formData,  
            success: function(response) {
                if (response.status === true) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function(xhr, status, error) {
                alert('Koi galti hui hai: ' + error);
            }
        });
    });
}
