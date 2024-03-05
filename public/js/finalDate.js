var startDate = document.getElementById("start_date");
var endDate = document.getElementById("end_date");

startDate.onchange = () => {
    calculateDays();
};

endDate.onchange = () => {
    calculateDays();
};

function calculateDays() {
    var startDateValue = document.getElementById("start_date").value;
    var endDateValue = document.getElementById("end_date").value;

    console.log(typeof endDateValue)

    var diff = 0;
    if (startDateValue && endDateValue) {
        diff = Math.floor((endDateValue.getTime() - startDateValue.getTime()) / 86400000);

        document.getElementById("final-date-counter").innerHTML =
            "Количество дней: " + diff;
    } else {
        document.getElementById("final-date-counter").innerHTML =
            '';
    }
}
