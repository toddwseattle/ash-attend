/**
 * checks whether only letters a-zA-z, and trims
 * @param {string} toCheck
 * @returns cleaned string or null if didn't check out
 */
const validDomains = [
  "ashesi.edu.gh",
  "aucampus.onmicrosoft.com",
  "ashesi.org",
  "alumni.ashesi.edu",
];
class FormValidation {
  constructor(fields, submitButtonId, messageContainer, messageElement) {
    this.fields = fields ? fields : [];
    this.submitButton = $(submitButtonId ? submitButtonId : "submit");
    this.isDirty = false;
    this.isValid = false;
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
    this.updateDisplay();
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
      this.messageContainer.append(newMessage.text(msg.message));
    });
  }
  formResultsMessage(msg) {
    const frm = { field: "form", message: msg };
    this.messages = [frm];
    this.insertMessagesInPage();
  }
  updateFromChange(event) {
    this.isDirty = true;
    let formValid = true;
    this.fields.forEach((field) => {
      if (event.target.name === field.name) {
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
            this.messages.push({
              field: field.name,
              message: `${field.description}: ${field.invalidMessage}`,
            });
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
}
const addFormFields = [
  {
    id: "#first",
    check: checkAlphaAndClean,
    description: "First Name",
    invalidMessage: "Must be Letters with no punctuation",
    name: "f_name",
    isValid: false,
    isDirty: false,
    value: "",
  },
  {
    id: "#last",
    check: checkAlphaAndClean,
    description: "Last Name",
    invalidMessage: "Must be Letters with no punctuation",
    name: "l_name",
    isValid: false,
    isDirty: false,
  },
  {
    id: "#email",
    check: checkEmailAndClean,
    description: "Email",
    invalidMessage: "Must be a valid Ashesi Domain",
    name: "email",
    isValid: false,
    isDirty: false,
  },
  {
    id: "input[name='gender']:checked",
    check: checkGender,
    description: "Gender",
    invalidMessage: "Must Select Gender: Male or Female",
    name: "gender",
    isValid: false,
    isDirty: false,
  },
];
function checkGender(toCheck) {
  if (toCheck === "Male" || toCheck === "Female") {
    return toCheck;
  } else {
    return null;
  }
}
function checkAlphaAndClean(toCheck) {
  const cleansed = toCheck.trim();
  if (/^[a-zA-Z]+$/.test(cleansed)) {
    return cleansed;
  } else {
    return null;
  }
}
function checkEmailAndClean(email) {
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
function add_student(student) {
  return new Promise((resolve, reject) => {
    $.post("../actions/add_user_action.php", student)
      .done((data) => resolve(data))
      .fail((error) => reject(error));
  });
}
/** processes the add student fields */
function process_fields(event, formValidation) {
  event.preventDefault();
  const student = formValidation.values;
  const displayName = `${student.f_name} ${student.l_name} (${student.email})`;
  add_student(student)
    .then((data) => {
      switch (data) {
        case "success":
          formValidation.formResultsMessage(
            `successfully added ${displayName}`
          );
          break;
        case "duplicate":
          formValidation.formResultsMessage(
            `${displayName} is a duplicate and was not added`
          );
          break;
        case "failed":
          formValidation.formResultsMessage(
            `unable to add ${displayName}: server error`
          );
          break;
      }
    })
    .catch((error) => {
      formValidation.formResultsMessage(
        `error attempting to contact server to add ${displayName}`
      );
    });
}

$(document).ready(() => {
  const addFormValidation = new FormValidation(
    addFormFields,
    "#addStudentSubmit"
  );
  $("#addForm").on("change", addFormValidation.updateFromChange);
  $("#addForm").on("submit", (event) => {
    process_fields(event, addFormValidation);
  });
});
