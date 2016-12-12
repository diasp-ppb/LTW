function btnHandler() {
    var user;

    $.ajax({
        url: '../templates/getActiveUser.php',
        type: 'get',
        async: false,
        success: function(data) {
            user = data;
        }
    });

    if (user) {
        document.getElementById("topbar-dropdown").classList.toggle("show");
    } else {
        $("#login-box").fadeIn(300);
        $('body').append('<div id="mask"></div>');
        $('#mask').fadeIn(300);

        $('#mask').on('click', function() {
            $('#mask, #login-box').fadeOut(300, function() {
                $('#mask').remove();
            });
            return false;
        });
    }
}


function boxHandler(event) {
    var boxOptions = document.getElementsByClassName("box-option");
    for (var i = 0; i < boxOptions.length; i++) {
        boxOptions[i].className = boxOptions[i].className.replace(" active", "");
    }

    event.target.className += " active";

    var login = document.getElementById("login");
    var register = document.getElementById("register");

    if (event.target.innerText === "Login") {
        register.style.display = "none";
        login.style.display = "block";
    } else {
        register.style.display = "block";
        login.style.display = "none";
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

$(document).ready(function() {
    $('#register-form input[name="confirm"], #register-form input[name="pass"]').change(function() {
        var pass = $('#register-form input[name="pass"]');
        var passVal = $.trim(pass.val());
        var confirm = $('#register-form input[name="confirm"]');
        var confirmVal = $.trim(confirm.val());

        if (passVal !== confirmVal) {
            confirm[0].setCustomValidity('Password confirmation must match the password field.');
        } else {
            confirm[0].setCustomValidity('');
        }
    });

    $('#register-form input[name="user"]').change(function() {
        var user = $('#register-form input[name="user"]');
        var exists;
        $.ajax({
            url: '../templates/existsUser.php',
            type: 'post',
            data: {
                user: $.trim(user.val())
            },
            async: false,
            success: function(data) {
                exists = data;
            }
        });

        if (exists == 1) {
            user[0].setCustomValidity('The desired username is already in use. Please select a different one.');
        } else {
            user[0].setCustomValidity('');
        }
    });

    $('#register-form input[name="email"]').change(function() {
        var email = $('#register-form input[name="email"]');
        var exists;
        $.ajax({
            url: '../templates/existsEmail.php',
            type: 'post',
            data: {
                email: $.trim(email.val())
            },
            async: false,
            success: function(data) {
                exists = data;
            }
        });

        if (exists == 1) {
            email[0].setCustomValidity('The desired email is already in use. Please select a different one.');
        } else {
            email[0].setCustomValidity('');
        }
    });

    $('#login-form input').change(function() {
        var user = $('#login-form input[name="user"]');
        var pass = $('#login-form input[name="pass"]');
        var valid;
        $.ajax({
            url: '../login/validateLogin.php',
            type: 'post',
            data: {
                user: $.trim(user.val()),
                pass: $.trim(pass.val()),
            },
            async: false,
            success: function(data) {
                valid = data;
            }
        });

        if (valid == 1) {
            user[0].setCustomValidity('');
        } else {
            user[0].setCustomValidity('Username or password incorrect. Please try again.');
        }
    });
});
