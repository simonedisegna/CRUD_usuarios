$(document).ready(function() {
    // Função para mostrar/ocultar senha
    function togglePasswordVisibility(passwordField, toggleIcon) {
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    }

    $('#togglePassword').on('click', function() {
        togglePasswordVisibility($('#password'), $(this));
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        var token = $('input[name="_token"]').val();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: {
                _token: token,
                email: email,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $('#login-alert').text(response.message).show();
                    if (response.error) {
                        console.log('Error: ' + response.error);
                        console.log('Trace: ' + response.trace);
                    }
                }
            },
            error: function(xhr) {
                $('#login-alert').text('Erro no servidor, tente novamente mais tarde.').show();
                console.log(xhr.responseText);
            }
        });
    });
});
