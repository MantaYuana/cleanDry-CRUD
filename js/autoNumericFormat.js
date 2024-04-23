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

// initialize AutoNumeric object for element with classname of currencyFormatRupiah
const currencyFormatRupiah = new AutoNumeric.multiple(
  ".currencyFormatRupiah",
  AutoNumericConfig
);
