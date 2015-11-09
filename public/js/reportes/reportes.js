var pieData = [
    {
        value: 300,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    },
    {
        value: 40,
        color: "#949FB1",
        highlight: "#A8B3C5",
        label: "Grey"
    },
    {
        value: 120,
        color: "#4D5360",
        highlight: "#616774",
        label: "Dark Grey"
    }

];

window.onload = function () {
    var asistencia = document.getElementById("asistencia").getContext("2d");
    var participacion = document.getElementById("participacion").getContext("2d");
    
    var desempeno = document.getElementById("desempeno").getContext("2d");
    var lectora = document.getElementById("lectora").getContext("2d");
    
    var matematica = document.getElementById("matematica").getContext("2d");
    var escolar = document.getElementById("escolar").getContext("2d");
    
    window.myPie = new Chart(asistencia).Pie(pieData);
    window.myPie = new Chart(participacion).Pie(pieData);
    
    window.myPie = new Chart(desempeno).Pie(pieData);
    window.myPie = new Chart(lectora).Pie(pieData);
    
    window.myPie = new Chart(matematica).Pie(pieData);
    window.myPie = new Chart(escolar).Pie(pieData);
};