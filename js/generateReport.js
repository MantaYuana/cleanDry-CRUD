// XMLHttp Object
const xhttp = new XMLHttpRequest();

// flatpickr datepicker
let date = new Date();
let today = `${date.getFullYear()}-${date.getMonth() + 1}-${
  date.getDate() + 1
} ${date.getHours()}:${date.getMinutes()}`;
const datePickerPaydate = flatpickr(".datePicker", {
  mode: "range",
  dateFormat: "d-m-Y",
  maxDate: today,
});

function showTransaction() {
  let startDate = flatpickr.formatDate(
    datePickerPaydate.selectedDates[0],
    "Y-m-d"
  );
  let endDate = flatpickr.formatDate(
    datePickerPaydate.selectedDates[1],
    "Y-m-d"
  );
  let option = [startDate, endDate];
  const transactionTable = document.getElementById("transaction-table-body");

  xhttp.onload = function () {
    transactionTable.innerHTML = this.response;
  };
  xhttp.open("POST", "transaction-control/render-reportTransaction.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("option=" + JSON.stringify(option));
}
