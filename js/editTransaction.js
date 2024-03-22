const additionalCostInput = new AutoNumeric(
  "#input-additionalCost",
  AutoNumericConfig
);
const paymentInput = new AutoNumeric("#input-payment", AutoNumericConfig);
const subTotalTxt = new AutoNumeric("#sub-total", AutoNumericConfig);
const taxTxt = new AutoNumeric("#tax", AutoNumericConfig);
const discountTxt = new AutoNumeric("#discount", AutoNumericConfig);
const totalTxt = new AutoNumeric("#total", AutoNumericConfig);
const changeTxt = new AutoNumeric("#change", AutoNumericConfig);

// flatpickr datepicker
let date = new Date();
let today = `${date.getFullYear()}-${date.getMonth() + 1}-${
  date.getDate() + 1
} ${date.getHours()}:${date.getMinutes()}`;
const datePickerDeadline = flatpickr(".datePicker", {
  enableTime: true,
  dateFormat: "Y-m-d H:i",
  //   minDate: today,
  time_24hr: true,
  allowInput: true,
});

const xhttp = new XMLHttpRequest();
let cartTransaction = JSON.parse(document.getElementById("order").value);
let costTransaction = JSON.parse(document.getElementById("cost").value);

function updateCart(orderIndex) {
  let package = cartTransaction[orderIndex - 1]["id"];
  xhttp.onload = function () {
    location.reload();
    console.log(this.responseText);
  };

  xhttp.open("POST", "../php/helper/transaction_process.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("orderID=" + package + "&process=destroyOrder");
}

function calculateCart() {
  let subtotal = 0;
  let discount = 0;
  let tax = 0;
  let total = 0;
  let paymentChange = 0;

  cartTransaction.forEach((element) => {
    subtotal = subtotal + element["harga_paket"] * element["qty"];
  });

  tax =
    (subtotal - discount + Number(additionalCostInput.getNumericString())) *
    0.0075;
  total =
    subtotal - discount + Number(additionalCostInput.getNumericString()) + tax;
  paymentChange = Number(paymentInput.getNumericString()) - total;

  subTotalTxt.set(subtotal);
  taxTxt.set(tax);
  discountTxt.set(discount);
  totalTxt.set(total);
  changeTxt.set(paymentChange);

  cost = [
    subtotal,
    discount,
    tax,
    total,
    Number(additionalCostInput.getNumericString()),
    Number(paymentInput.getNumericString()),
  ];
  document.getElementById("input-cost").value = JSON.stringify(cost);
}

calculateCart();
paymentInput.set(cost[3] + Number(costTransaction["kembalian"]));
changeTxt.set(costTransaction["kembalian"]);
calculateCart();