$(document).ready(function() {
    console.log('collegato');
    var idPlace = $('#place-id').val();
    var mesi = moment.months();
    $.ajax({
        url : "http://127.0.0.1:8000/api/getData?id=" + idPlace,
        method :"GET",
        success : function (data) {
            var risultati = data;
            var dataMonths = costruttoreDatiMesi(risultati);
            // var visualTotali = dataMonths.reduce(myFunc);
            myGraph(mesi, dataMonths);
            function costruttoreDatiMesi(array) {
                var rawObj = {};
                var datoCompleto = [];
                for (var x = 0; x < 12; x++) {
                    if (rawObj[x] === undefined) {
                        rawObj[x] = 0;
                    }
                }
                for (var i = 0; i < array.length; i++) {
                   var visita = array[i];
                   var giorno = visita.created_at;
                   var mese = moment(giorno, "DD-MM-YYYY").clone().month();
                   rawObj[mese] += 1;
                }
                for (var key in rawObj) {
                   datoCompleto.push(rawObj[key]);
                }
                return datoCompleto;
            };
            function myGraph(mesi, views) {
                var ctx = $('#myChart');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: mesi,
                        datasets: [{
                            label: 'Visite mensili',
                            backgroundColor: 'lightblue',
                            borderColor: 'blue',
                            lineTension: 0.5,
                            data: views
                        }]
                    },
                });
            }
            function myFunc(total, num) {
                return total + num;
            }
        },
        error : function () {
            alert("E' avvenuto un errore. ");
        }
    });
});
