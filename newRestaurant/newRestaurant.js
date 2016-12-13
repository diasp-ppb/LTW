$(document).ready(function() {
    $('input[name="name"], input[name="address"]').change(function() {
        var name = $('input[name="name"]');
        var address = $('input[name="address"]');
        var exists;
        $.ajax({
            url: 'existsRestaurant.php',
            type: 'post',
            data: {
                name: name.val(),
                address: address.val()
            },
            async: false,
            success: function(data) {
                exists = data;
            }
        });

        if (exists == 1) {
            name[0].setCustomValidity('The desired name/address combination already exists.');
        } else {
            name[0].setCustomValidity('');
        }
    });
});
