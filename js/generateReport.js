// XMLHttp Object
const xhttp = new XMLHttpRequest();

// flatpickr datepicker
let date = new Date();
let dateLimit = `${date.getFullYear()}-${date.getMonth() + 1}-${
  date.getDate() + 1
} ${date.getHours()}:${date.getMinutes()}`;

const datePickerPaydate = flatpickr(".datePicker", {
  mode: "range",
  dateFormat: "d-m-Y",
  maxDate: dateLimit,
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
  var datatable = $("#dataTable").DataTable();

  xhttp.onload = function () {
    datatable.clear();
    datatable.rows.add(JSON.parse(this.responseText));
    datatable.draw();
    console.log(this.responseText);
  };
  xhttp.open("POST", "transaction-control/render-reportTransaction.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("option=" + JSON.stringify(option));
}
