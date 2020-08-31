import { FormValidation, validDomains } from "../form_validation.js";
import $ from "jquery";
global.$ = global.jQuery;
// some form values for setup
const testFormHTML = {
  open: '<form action="" id="test-form">',
  close: "</form>",
};
const basicTextHTML = '<input id="basicText" name="basicText" type="text">';
const submitButtonHTML = ' <button type="submit" id="submit">Submit</button>';

describe("Test Form Validation Class ", () => {
  let tFormValid;
  let tFields;
  beforeEach(() => {
    tFormValid = new FormValidation({jquery:$});
    tFields = [
      {
        id: "#basicText",
        check: (check) => check,
        description: "Session Description",
        invalidMessage: "Must not be blank",
        name: "description",
        minCheck: 1,
      },
    ];
    document.body.innerHTML =
      testFormHTML["open"] +
      basicTextHTML +
      submitButtonHTML +
      testFormHTML["close"];
  });
  it("should have an empty fields property if an empty new", () => {
    expect(tFormValid.fields.length).toEqual(0);
  });
  it("should have submitButton defined", () => {
    expect(tFormValid.submitButton).toBeTruthy();
  });
  it("submitButton should have an id of submit", () => {
    expect(tFormValid.submitButton.attr("id")).toEqual("submit");
  });
  it('should have a disabled submit button', () => {
    expect(tFormValid.submitButton.prop("disabled")).toBeTruthy();
  });
  it('should have an empty array of formValidators', () => {
    expect(tFormValid.formValidators.length).toEqual(0);
  });
   it('should throw an error if a non functions is added as a listener', () => {
     expect(() => {
      tFormValid.addFormValidatorFunction("not a function");
     }).toThrowError();
   });
   it('should add a FormValidatorFunction', () => {
     const validator = {func: () => {return true;}, message:"Always True"};
     tFormValid.addFormValidatorFunction(validator);
     expect(tFormValid.formValidators[0]).toEqual(validator);
   });
   it('should fire a formValidator on form change', () => {
     let validatorFired = false;
     const validator = {func: () => {validatorFired=true; return true;}, message:"Always True"};
     tFormValid.addFormValidatorFunction(validator);
     tFormValid.checkFormLevelErrors();
     expect(validatorFired).toEqual(true);
   });
   it('should return true if the validator was true', () => {
    const validator = {func: () => { return true;}, message:"always true"};
    tFormValid.addFormValidatorFunction(validator);
    expect(tFormValid.checkFormLevelErrors()).toBeTruthy();
   });
   it('should pass the form to the validator', () => {
     let passedForm;
     const validator = {func:(form) => { passedForm = form; return true; }, message: "always true"};
     tFormValid.addFormValidatorFunction(validator);
     tFormValid.checkFormLevelErrors();
     expect(passedForm).toEqual(tFormValid);
   });
   it('should checkFormLevelErrors should return false  if the validator returns false', () => {
    const validator = {func:(form) => {  return false; }, message: "always true"};
    tFormValid.addFormValidatorFunction(validator);
    expect(tFormValid.checkFormLevelErrors()).toBeFalsy();;
   });
   

});
