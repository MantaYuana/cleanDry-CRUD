// XMLHttp object
const xhttp = new XMLHttpRequest();

// flatpickr datepicker object
let date = new Date();
// format today date into dd-m-YYYY HH:MM
let today = `${date.getDate()}-${
  date.getMonth() + 1
}-${date.getFullYear()} ${date.getHours()}:${
  (date.getMinutes() < 10 ? "0" : "") + date.getMinutes()
}`;

const datePickerPaydate = flatpickr(".datePicker", {
  mode: "range",
  dateFormat: "d-m-Y",
  maxDate: today,
});

/**
 * Get transaction for printTransaction.php from render-reportTransaction.php
 *
 * this is an AJAX function so data in page can change dynamically
 */
function showTransaction() {
  // get datepicker start date
  let startDate = flatpickr.formatDate(
    datePickerPaydate.selectedDates[0],
    "Y-m-d"
  );

  // get datepicker end date
  let endDate = flatpickr.formatDate(
    datePickerPaydate.selectedDates[1],
    "Y-m-d"
  );

  let option = [startDate, endDate];
  var datatable = $("#dataTable").DataTable();

  xhttp.onload = function () {
    // clear table before receiving data
    datatable.clear();
    // load response from render-reportTransaction.php
    datatable.rows.add(JSON.parse(this.responseText));
    // redraw table
    datatable.draw();
  };
  xhttp.open("POST", "transaction-control/render-reportTransaction.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("option=" + JSON.stringify(option));
}
