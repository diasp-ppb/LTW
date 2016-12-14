var displayEdit = false;
function changeEdit(){
    var edit = document.getElementById('editRestaurant');
    if(!displayEdit)
    {
        edit.style.display = "block";
        displayEdit = true;
    }
    else{
        edit.style.display = "none";
        displayEdit = false;
    }
}

$(document).ready(
    function(){
        $('#fileToUpload').change(
            function(){
                if ($(this).val()) {
                    $('#submitPhoto').css("display", "inline");
                }
            }
        );
    });
