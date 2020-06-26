$(document).ready(function() {
    console.log('collegato');
    var idPlace = $('#place-id').val();
    console.log(idPlace);

    $.ajax({
        url : "http://127.0.0.1:8000/api/getData?id=" + idPlace,
        method :"GET",
        success : function (data) {
            console.log(data);
        },
        error : function () {
            alert("E' avvenuto un errore. ");
        }
    });
});
