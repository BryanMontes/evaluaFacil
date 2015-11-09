var randomScalingFactor = function () {
    return Math.round(Math.random() * 100)
};

var barChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
        }
    ]

}
window.onload = function () {
    var asistencia = document.getElementById("asistencia").getContext("2d");
    var participacion = document.getElementById("participacion").getContext("2d");

    var desempeno = document.getElementById("desempeno").getContext("2d");
    var lectora = document.getElementById("lectora").getContext("2d");

    var matematica = document.getElementById("matematica").getContext("2d");    
    var convivencia = document.getElementById("convivencia").getContext("2d");

    window.myBar = new Chart(asistencia).Bar(barChartData, {
        responsive: false
    });

    window.myBar = new Chart(participacion).Bar(barChartData, {
        responsive: true
    });

    window.myBar = new Chart(desempeno).Bar(barChartData, {
        responsive: true
    });

    window.myBar = new Chart(lectora).Bar(barChartData, {
        responsive: true
    });

    window.myBar = new Chart(matematica).Bar(barChartData, {
        responsive: true
    });

     window.myBar = new Chart(convivencia).Bar(barChartData, {
        responsive: true
    });
}
