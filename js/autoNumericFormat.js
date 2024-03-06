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

const currencyFormatRupiah = new AutoNumeric.multiple(
  ".currencyFormatRupiah",
  AutoNumericConfig
);
