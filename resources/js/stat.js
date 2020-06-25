$(document).ready(function() {
    var id = $('input-id').val();

    $.ajax({
        url : "http://127.0.0.1:8000/api/getData",
        method :"GET",
        data : $('#input-id').val(),
        data : {
            id: id
        },
        success : function (data) {
            console.log(data);
        },
        error : function () {
            alert("E' avvenuto un errore. ");
        }
    });
});
