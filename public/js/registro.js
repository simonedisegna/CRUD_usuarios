$(document).ready(function() {
    $('#registroForm').on('submit', function(e) {
        e.preventDefault();
        var isValid = true;

        // Limpar mensagens de feedback
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');

        // Validação do nome
        var nome = $('#nome').val();
        if (nome === '') {
            isValid = false;
            $('#nome').addClass('is-invalid');
            $('#nomeFeedback').text('O nome é obrigatório.');
        }

        // Validação do email
        var email = $('#email').val();
        if (email === '') {
            isValid = false;
            $('#email').addClass('is-invalid');
            $('#emailFeedback').text('O email é obrigatório.');
        }

        // Validação da senha
        var password = $('#password').val();
        var passwordConfirmation = $('#password_confirmation').val();
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (password === '') {
            isValid = false;
            $('#password').addClass('is-invalid');
            $('#passwordFeedback').text('A senha é obrigatória.');
        } else if (!passwordRegex.test(password)) {
            isValid = false;
            $('#password').addClass('is-invalid');
            $('#passwordFeedback').text('A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um dígito.');
        }

        // Validação da confirmação de senha
        if (passwordConfirmation !== password) {
            isValid = false;
            $('#password_confirmation').addClass('is-invalid');
            $('#passwordConfirmationFeedback').text('As senhas não coincidem.');
        }

        if (isValid) {
            this.submit();
        }
    });

    // Alternar visibilidade da senha
    $('#togglePassword').click(function() {
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');
        if (passwordFieldType == 'password') {
            passwordField.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $('#togglePasswordConfirmation').click(function() {
        var passwordConfirmationField = $('#password_confirmation');
        var passwordConfirmationFieldType = passwordConfirmationField.attr('type');
        if (passwordConfirmationFieldType == 'password') {
            passwordConfirmationField.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordConfirmationField.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Verificar se a confirmação de senha corresponde à senha
    $('#password_confirmation').on('keyup', function() {
        var password = $('#password').val();
        var confirmation = $(this).val();
        if (confirmation !== password) {
            $('#password_confirmation').addClass('is-invalid');
            $('#passwordConfirmationFeedback').text('As senhas não coincidem.');
        } else {
            $('#password_confirmation').removeClass('is-invalid');
            $('#passwordConfirmationFeedback').text('');
        }
    });


});
