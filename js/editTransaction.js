// initialize AutoNumeric object for specific element
// so that elements can return its value for its specific object
const additionalCostInput = new AutoNumeric(
  "#input-additionalCost",
  AutoNumericConfig
);
const paymentInput = new AutoNumeric("#input-payment", AutoNumericConfig);
const subTotalTxt = new AutoNumeric("#sub-total", AutoNumericConfig);
const taxTxt = new AutoNumeric("#tax", AutoNumericConfig);
const discountTxt = new AutoNumeric("#discount", AutoNumericConfig);
const totalTxt = new AutoNumeric("#total", AutoNumericConfig);
const paidTxt = new AutoNumeric("#paid", AutoNumericConfig);
const changeTxt = new AutoNumeric("#change", AutoNumericConfig);

// flatpickr datepicker object
let date = new Date();
// format today date into dd-m-YYYY HH:MM
let today = `${date.getFullYear()}-${date.getMonth() + 1}-${
  date.getDate() + 1
} ${date.getHours()}:${date.getMinutes()}`;
const datePickerDeadline = flatpickr(".datePicker", {
  enableTime: true,
  minuteIncrement: 1,
  minTime: "08:00",
  maxTime: "20:00",
  dateFormat: "Y-m-d H:i",
  time_24hr: true,
  allowInput: true,
});

const xhttp = new XMLHttpRequest();
let cartTransaction = JSON.parse(document.getElementById("order").value);
let costTransaction = JSON.parse(document.getElementById("cost").value);

function updateCart(orderIndex, transactionID) {
  // this function is to update (remove an order) cart

  // get selected package from cart and remove selected order
  let package = cartTransaction[orderIndex - 1]["id"];
  cartTransaction.splice(orderIndex - 1, 1);

  // display message from transaction_process and recalculate cart price
  xhttp.onload = function () {
    alert(this.responseText);
    calculateCart();
    document.getElementById("transaction-form").submit();
  };

  xhttp.open("POST", "../php/helper/transaction_process.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "transactionID=" +
      transactionID +
      "&orderID=" +
      package +
      "&process=destroyOrder"
  );
}

function calculateCart() {
  let subtotal = 0;
  let discount;
  let tax = 0;
  let total = 0;
  let paymentChange = 0;

  cartTransaction.forEach((element) => {
    subtotal = subtotal + element["harga_paket"] * element["qty"];
  });

  discount = Number(discountTxt.getNumericString())

  tax =
    (subtotal - discount + Number(additionalCostInput.getNumericString())) *
    0.0075;
  total =
    subtotal - discount + Number(additionalCostInput.getNumericString()) + tax;
  paymentChange =
    Number(paymentInput.getNumericString()) +
    Number(paidTxt.getNumericString()) -
    total;

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
    paymentChange,
  ];
  document.getElementById("input-cost").value = JSON.stringify(cost);
}

calculateCart();
paidTxt.set(cost[3] + Number(costTransaction["kembalian"]));
changeTxt.set(costTransaction["kembalian"]);
calculateCart();