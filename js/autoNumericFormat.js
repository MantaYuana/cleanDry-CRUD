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

const currencyFormatRupiah = new AutoNumeric.multiple(".currencyFormatRupiah", AutoNumericConfig);

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

