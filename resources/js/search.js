$(document).ready(function() {
// var places= <?php echo "42";?>;
// var places = $('#places-in-range').val();
// console.log(places);



    $.ajax({
        url : "http://127.0.0.1:8000/api/placesInRange",
        method :"GET",
        data : {
            lat: $('#places-lat').val(),
            long: $('#places-long').val()
        },
        success : function (data) {
            console.log(data);
        },
        error : function () {
            alert("E' avvenuto un errore. ");
        }
    });

});
