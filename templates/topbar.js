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
    $('#register-form').submit(function() {
        var user = $.trim($('#register-form input[name="user"]').val());
        var pass = $.trim($('#register-form input[name="pass"]').val());
        var confirm = $.trim($('#register-form input[name="confirm"]').val());

        if (user === '') {
            alert('Please write a username.');
            return false;
        }

        if (pass === '') {
            alert('Please write a password.');
            return false;
        }

        if (pass !== confirm) {
            alert('Password does not match the confirmation field.');
            return false;
        }
    });

    $('#login-form').submit(function() {
        var user = $.trim($('#login-form input[name="user"]').val());
        var pass = $.trim($('#login-form input[name="pass"]').val());

        if (user === '') {
            alert('Please write a username.');
            return false;
        }

        if (pass === '') {
            alert('Please write a password.');
            return false;
        }
    });
});
