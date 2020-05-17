$(document).ready(function() {
    $('.signin').on("click",function() {
        window.location.href = amigable("?module=login&function=view_signin");
    });
    $('.login').on("click",function() {
        window.location.href = amigable("?module=login");
    });
    $('.home').on("click",function() {
        window.location.href = amigable("?module=home");
    });
    validate_login_js();
});

function validate_login_js() {
    $('#login_').on("click",function() {
        var email = $('input[name=email]').val();
        var password = $('input[name=password]').val();
        var num_errors = 0;
        
        //Email
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!email) {
            $('#error_email').html('El campo nombre es obligatorio');
            num_errors++;
        } else if (!regex.test(email)) {
            $('#error_email').html('El email es incorrecto');
            num_errors++;
        } else
            $('#error_email').html('');

        //Password
        if(!password) {
            $('#error_password').html('El campo contraseña es obligatorio');
            num_errors++;
        } else if (password.length < 6 || password.length > 8) {
            $('#error_password').html('Las contraseñas deben de tener entre 6 y 8 caracteres');
            num_errors++;
        } else {
            $('#error_password').html('');
        }

        if (num_errors == 0) {
            validate_login_php(email,password);
        }
    });
}

function validate_login_php(email,password) {
    $.ajax({
		type: 'POST',
		url: amigable("?module=login&function=login"),
		data: {
            email: email,
            password: password
        },
		success: function(result) {
            if (result == true)
                window.location.href = amigable("?module=home");
            else if (result == false)
                window.location.href = amigable("?module=cart");
            else
                $('#error_email').html(result);
        }
    });
}