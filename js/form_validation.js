
/**
 * A helper class to create form errors.  these are assigned to the
 * messages property of @class FormValidation.
 * @member field {string} form field
 * @member id {string} id of the message
 * @member message {string} the error message
 * @member errorString {function} by default returns `${field}: ${message}`
 */
export class FormError {
  constructor({ id, field, message }) {
    this.field = field ? field : "form";
    this.id = id ? id : this.field;
    this.message = message ? message : "Form Error (default)";
    this.msgTemplate = `${this.message}`;
  }
  errorString() {
    return this.msgTemplate;
  }
} /**
 * Creates a FormValidation Object
  @member fields : what fields are validate
  @member submitButton : ide of submit button or submit by default
  @member messageContainer id of div where messages should go
  @member messageElement a template element to create the message. 
  @member isDirty
  @member isValid
  
     
 */
export class FormValidation {
  /**
   * 
   * @param options 
   * { fields:  array of fields to validate
   *   submitButton: id of submit button or "submit" by default
   *  messageContainer id of div where messages should go
   * messageElement a template html element to create the message
   * jquery jquery global.  otherwise assume $ is defined. (useful in testing
   * )}
   */
  constructor({fields, submitButtonId, messageContainer, messageElement, jquery}) {
    this.jquery = jquery ? jquery : $;
    this.fields = fields ? fields : [];
    this.submitButton = this.jquery(submitButtonId ? submitButtonId : "#submit");
    this.isDirty = false;
    this.isValid = false;
    /**
     * an array of @class FormErrors with at least a field and a message
     */
    this.messages = [];
    this.updateFromChange = this.updateFromChange.bind(this);
    this.messageContainer = messageContainer
      ? messageContainer
      : this.jquery("#form-errors");
    this.messageElement = messageElement
      ? messageElement
      : this.jquery('<p class="error-msg"></p>');
    this.noMessageStyle = "display:none";
    this.messageStyle = "display:inline";
    this.formValidators = [];
    this.addListenersToFields();
    this.updateDisplay();
  }
 
  addListenersToFields() {
    this.fields.forEach((field) => {
      if (this.jquery(field.id).length > 0) {
        this.jquery(field.id).on("input", this.updateFromChange);
      } else {
        console.log(
          `FormValidation class: unable to attach listener to $('${field.id}') it's not here`
        );
      }
    });
  }
  updateDisplay() {
    this.insertMessagesInPage();
    if (this.isValid) {
      this.submitButton.prop("disabled", false);
    } else {
      this.submitButton.prop("disabled", true);
    }
  }
  insertMessagesInPage() {
    this.messageContainer.empty();
    if (!this.messages || this.messages.length === 0) {
      this.messageContainer.css("style", this.noMessageStyle);
      this.messageContainer.hide();
    } else {
      this.messageContainer.css("style", this.messageStyle);
      this.messageContainer.show();
    }
    this.messages.forEach((msg) => {
      const newMessage = this.messageElement.clone();
      this.messageContainer.append(newMessage.text(msg.errorString()));
    });
  }
  formResultsMessage(msg) {
    let frm;
    if (typeof msg === "string") {
      frm = new FormError({ field: "form", message: msg });
    } else {
      frm = msg;
    }
    this.messages = [frm];
    this.insertMessagesInPage();
  }
  /**removes any errors (this.messages) at the form level from the array */
  clearFormLevelErrors() {
    const clearedErrors = [];
    this.messages.forEach((msg) => {
      if (msg.field !== "form") {
        clearedErrors.push(msg);
      }
      this.messages = clearedErrors;
    });
  }
  addFormValidatorFunction(validator) {
    if(typeof validator.func==="function") {
    validator.message = validator.message ?validator.message : "Invalid Form";
    this.formValidators.push(validator);
    } else {
      throw("not a validator function");
    }
  }
  checkFormLevelErrors() {
    let valid=true;
    this.formValidators.forEach(fv => {
      const fvValid = fv.func(this);
      if(!fvValid) {
      const fvError = new FormError({field:"form", message:fv.message});
      this.messages.push(fvError);
      }
      valid= valid && fvValid;
    });
    return valid;
  }
  getFieldValue(field) {
    let value = null;
    switch (this.jquery(field.id).prop("type")) {
      case "checkbox":
        value = this.jquery(field.id).prop("checked");
        break;

      default:
        value =
          this.jquery(field.id).val() &&
          this.jquery(field.id).val().length > (field.minCheck ? field.minCheck : 0)
            ? this.jquery(field.id).val()
            : null;
        break;
    }
    return value;
  }
  updateFromChange(event) {
    this.isDirty = true;
    let formValid = true;
    this.clearFormLevelErrors();
    formValid = this.checkFormLevelErrors();
    this.fields.forEach((field) => {
      if (event.target.name.indexOf(field.name) >= 0) {
        field.isDirty = true;
        if (this.getFieldValue(field) !== null) {
          field.isDirty = true;
          // remove any messages about the field that are outdated
          if (this.messages.length > 0) {
            const newMessages = [];
            this.messages.forEach((msg) => {
              if (msg.field !== field.name) newMessages.push(msg);
            });
            this.messages = newMessages;
          }
          const value = field.check(this.getFieldValue(field), field);
          if (value === null) {
            this.messages.push(
              new FormError({
                field: field.name,
                message: `${field.description}: ${field.invalidMessage}`,
              })
            );
            field.isValid = false;
          } else {
            field.isValid = true;
            field.value = value;
          }
        }
      }
      formValid = field.isDirty ? formValid && field.isValid : formValid;
    }); // end fields.forEach
    this.isValid = formValid;
    this.updateDisplay();
  }
  get values() {
    const retValue = {};
    this.fields.forEach((field) => {
      if(!field.name) { console.log(`error: ${field.id} does not have a name defined`);};
      retValue[field.name] = field.value;
    });
    return retValue;
  }
  set values(value) {}
}
/**
 *
 * @param {string } toCheck Gender to Check
 * @returns {string} Male or Female (null if invalid)
 */
export function checkGender(toCheck) {
  toCheck = toCheck.trim();
  if (toCheck.toLowerCase() === "male" || toCheck.toLowerCase() === "female") {
    return toCheck;
  } else {
    return null;
  }
}
/**
 * checks whether only letters a-zA-z or - for hyphenated names, and trims
 * @param {string} toCheck
 * @returns cleaned string or null if didn't check out
 */
export function checkAlphaAndClean(toCheck) {
  const cleansed = toCheck.trim();
  if (/^[a-zA-Z\-]+$/.test(cleansed)) {
    return cleansed;
  } else {
    return null;
  }
}
/**
 * our application checks against a list of valid domains which
 * we export as a constant.  all Ashesi emails are in one of these domains
 */
export const validDomains = [
  "ashesi.edu.gh",
  "aucampus.onmicrosoft.com",
  "ashesi.org",
  "alumni.ashesi.edu",
];
/**
 * trims and validates that email addresses.  checks against
 * array of strings "validDomains"
 *
 * @param {email name to check} email
 * @returns null if failed or clean email
 */
export function checkEmailAndClean(email) {
  const ashesiEduEmailParts = /^([a-z0-9\_\-\.]+)@([a-z0-9]+(?:[.-][a-z0-9]+)*\.[a-z]{2,})$/i;
  const cleanMail = email.trim();
  let returnValue = null;
  const parts = ashesiEduEmailParts.exec(cleanMail); // [name,domain]
  if (parts && parts.length === 3 && parts[2]) {
    validDomains.forEach((d) => {
      if (d === parts[2].toLowerCase()) {
        returnValue = cleanMail;
      }
    });
  }
  return returnValue;
}
