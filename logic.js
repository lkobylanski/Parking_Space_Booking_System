let dayToday;
let classDate = document.getElementsByClassName("input_date"); //returns array of elements with specified class

document.addEventListener("DOMContentLoaded", setDates);
document.addEventListener("DOMContentLoaded", inputDates);
document.addEventListener("DOMContentLoaded", loadValidation);

function setDates() { // With this function I'll set the min and max date value to prevent user from providing invalid values. This function will triger when the DOM is loaded
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth()+1; // because it counts month from 0
    let yyyy = today.getFullYear();

    if(dd < 10){
        dd = '0' + dd; // 01, 02 ... 09 - one digit vaules need to be in this form  for html to properly read min values that JS is setting onload
    }
    if(mm < 10){
        mm = '0' + mm;
    }

    let thisday = yyyy + "-" + mm + "-" + dd;

    return dayToday = thisday;
}

function inputDates() {
    document.getElementById("startDate").min = dayToday;
    document.getElementById("endDate").min = dayToday;
    document.getElementById("startDate").value = dayToday;
    document.getElementById("endDate").value = dayToday;
    return;
}

function compareDates() {
    let start_date = document.getElementById("startDate");
    let end_date = document.getElementById("endDate");

    if(start_date.value > end_date.value) {
        alert("Booking START date can not be later than booking end date");
        start_date.value = dayToday;
    }
    return;
}

// adding on change eventlistner for each element with specified class
function loadValidation(){
    for(let i = 0; i < classDate.length; i++){
        classDate[i].addEventListener("change", compareDates);
    }
}