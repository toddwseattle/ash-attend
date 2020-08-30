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
}
export class FormValidation {
  constructor(fields, submitButtonId, messageContainer, messageElement) {
    this.fields = fields ? fields : [];
    this.submitButton = $(submitButtonId ? submitButtonId : "submit");
    this.isDirty = false;
    this.isValid = false;
    /**
     * an array of @class FormErrors with at least a field and a message
     */
    this.messages = [];
    this.updateFromChange = this.updateFromChange.bind(this);
    this.messageContainer = messageContainer
      ? messageContainer
      : $("#form-errors");
    this.messageElement = messageElement
      ? messageElement
      : $('<p class="error-msg"></p>');
    this.noMessageStyle = "display:none";
    this.messageStyle = "display:inline";
    this.addListenersToFields();
    this.updateDisplay();
  }
  addListenersToFields() {
    this.fields.forEach((field) => {
      if ($(field.id).length > 0) {
        $(field.id).on("input", this.updateFromChange);
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
  updateFromChange(event) {
    this.isDirty = true;
    let formValid = true;
    this.clearFormLevelErrors();
    this.fields.forEach((field) => {
      if (event.target.name.indexOf(field.name) >= 0) {
        field.isDirty = true;
        if ($(field.id).val() && $(field.id).val().length > 1) {
          field.isDirty = true;
          // remove any messages about the field that are outdated
          if (this.messages.length > 0) {
            const newMessages = [];
            this.messages.forEach((msg) => {
              if (msg.field !== field.name) newMessages.push(msg);
            });
            this.messages = newMessages;
          }
          const value = field.check($(field.id).val());
          if (!value) {
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
      formValid = formValid && field.isValid;
    }); // end fields.forEach
    this.isValid = formValid;
    this.updateDisplay();
  }
  get values() {
    const retValue = {};
    this.fields.forEach((field) => {
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
