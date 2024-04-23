// AutoNumeric config
const AutoNumericConfig = {
  currencySymbol: "Rp",
  decimalCharacter: ",",
  digitGroupSeparator: ".",
  maximumValue: "1000000000",
  modifyValueOnWheel: false,
  unformatOnSubmit: true,
  emptyInputBehavior: "always",
  watchExternalChanges: true,
};

// initialize AutoNumeric Object
const packagePriceTxt = new AutoNumeric(
  "#transaction-harga",
  AutoNumericConfig
);
const orderTotalTxt = new AutoNumeric("#transaction-total", AutoNumericConfig);
const paymentInput = new AutoNumeric("#input-payment", AutoNumericConfig);
const additionalCostInput = new AutoNumeric(
  "#input-additionalCost",
  AutoNumericConfig
);
const changeTxt = new AutoNumeric("#change", AutoNumericConfig);
const subTotalTxt = new AutoNumeric("#sub-total", AutoNumericConfig);
const taxTxt = new AutoNumeric("#tax", AutoNumericConfig);
const discountTxt = new AutoNumeric("#discount", AutoNumericConfig);
const totalTxt = new AutoNumeric("#total", AutoNumericConfig);

// flatpickr datepicker
let date = new Date();
let today = `${date.getFullYear()}-${date.getMonth() + 1}-${
  date.getDate() + 1
} ${date.getHours()}:${date.getMinutes()}`;
const datePickerDeadline = flatpickr(".datePicker", {
  enableTime: true,
  minuteIncrement: 1,
  minTime: "08:00",
  maxTime: "20:00",
  dateFormat: "Y-m-d H:i",
  minDate: today,
  time_24hr: true,
  allowInput: true,
  inline: true,
});

// Bootstrap Modal
const messageModal = new bootstrap.Modal(
  document.getElementById("modal-message")
);
const toggleMessageModal = document.getElementById("toggleMyModal");

// XMLHttp Object
const xhttp = new XMLHttpRequest();
let cart = [];
let cost = [];

function updateTotal() {
  orderTotalTxt.set(
    packagePriceTxt.getNumericString() *
      document.getElementById("transaction-quantity").value
  );
}

function updateInfo() {
  const customer = document.getElementById("transaction-name").value;
  const packageVal = document.getElementById("transaction-package").value;

  xhttp.onload = function () {
    let response = null;
    response = JSON.parse(this.response);

    if (
      response.telp != null &&
      response.nama != null &&
      response.benefit != null
    ) {
      document.getElementById("transaction-telp").value = response.telp;
      document.getElementById("transaction-fullName").value = response.nama;
      document.getElementById("transaction-benefit").value = response.benefit;
    } else {
      document.getElementById("transaction-name").value = "";
      document.getElementById("transaction-telp").value = "";
      document.getElementById("transaction-fullName").value = "";
      document.getElementById("transaction-benefit").value = "";
    }

    if (response.nama_paket != null && response.harga != null) {
      switch (response.jenis) {
        case "kiloan":
          response.jenis = "by weight";
          break;
        case "selimut":
          response.jenis = "Blanket";
          break;
        case "bed_cover":
          response.jenis = "Bed Cover";
          break;
        case "kaos":
          response.jenis = "Shirt";
          break;
        case "lain":
          response.jenis = "Other";
          break;

        default:
          response.jenis = "error type";
          break;
      }
      document.getElementById("transaction-paket").innerHTML =
        response.nama_paket;
      document.getElementById("transaction-jenis").innerHTML = response.jenis;
      document.getElementById("transaction-harga").value = response.harga;
      updateTotal();
    } else {
      document.getElementById("transaction-package").value = "";
      document.getElementById("transaction-paket").innerHTML = "";
      document.getElementById("transaction-jenis").innerHTML = "";
      document.getElementById("transaction-harga").value = "";
    }
  };

  xhttp.open("POST", "transaction-control/stage-transaction.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("customer=" + customer + "&package=" + packageVal);
}

function updateCart() {
  const packageID = document.getElementById("transaction-package").value;
  const quantity = document.getElementById("transaction-quantity").value;
  const packagePrice = packagePriceTxt;
  const orderNotes = document.getElementById("transaction-notes").value;

  // check if an inputed package ID and quantity is a valid number
  if (packageID != 0 && quantity != 0) {
    let checkOrder = false;

    // check if an inputed order exists in cart
    cart.forEach((element) => {
      if (element["packageID"] == packageID) {
        checkOrder = true;
      }
    });

    // if false then push order into cart, render cart, and calculate new price
    if (checkOrder == false) {
      let order = {
        packageID: `${packageID}`,
        quantity: `${quantity}`,
        price: `${packagePrice.getNumericString()}`,
        note: `${orderNotes}`,
      };
      cart.push(order);
      document.getElementById("input-cart").value = JSON.stringify(cart);
      showCart();
      calculateCart();
    } else {
      // if true throw a warning, cannot add same type of package
      // TODO: change modal into Toasts
      document.getElementById("modal-message-title").innerHTML = "Error !";
      document.getElementById("modal-message-body").innerHTML =
        "Cannot add the same type of package twice !";
      messageModal.show(toggleMessageModal);
    }
  } else {
    // TODO: change modal into Toasts
    document.getElementById("modal-message-title").innerHTML = "Warning !";
    document.getElementById("modal-message-body").innerHTML =
      "Please enter package ID and quantity !";
    messageModal.show(toggleMessageModal);
  }
}

function showCart() {
  const transactionTable = document.getElementById("transaction-table-body");

  xhttp.onload = function () {
    transactionTable.innerHTML = this.response;
  };
  xhttp.open("POST", "transaction-control/render-transaction.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("cart=" + JSON.stringify(cart));
}

function deleteCartOrder(order) {
  let orderIndex = -1;
  let temp = cart;

  // find index of selected order 
  temp.forEach((element) => {
    if (element["packageID"] == order) {
      return;
    }
    orderIndex++;
  });
  cart.splice(orderIndex, 1);
  showCart();
}

function calculateCart() {
  let subtotal = 0;
  let discount = 0;
  let tax = 0;
  let total = 0;
  let paymentChange = 0;

  cart.forEach((element) => {
    subtotal = subtotal + element["price"] * element["quantity"];
  });

  if (document.getElementById("transaction-benefit").value == "Discount") {
    discount = 10000;
  }

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
    Number(discountTxt.getNumericString()),
    tax,
    total,
    Number(additionalCostInput.getNumericString()),
    paymentChange,
  ];
  document.getElementById("input-cost").value = JSON.stringify(cost);

  checkOrder();
}

function checkOrder() {
  // function to enable submit if cart is empty
  if (cart.length > 0) {
    document.getElementById("btn-submit").disabled = false;
  } else {
    document.getElementById("btn-submit").disabled = true;
  }
}
