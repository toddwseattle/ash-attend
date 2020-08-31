import {
  FormValidation,
  checkGender,
  checkAlphaAndClean,
  checkEmailAndClean,
} from "./form_validation.js";
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
    invalidMessage: 'Must be Letters with only a hyphen ("-") for punctuation',
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
  const addFormValidation = new FormValidation({fields:
    addFormFields,
   submitButtonId: "#addStudentSubmit"}
  );
  $("#addForm").on("change", addFormValidation.updateFromChange);
  $("#addForm").on("submit", (event) => {
    process_fields(event, addFormValidation);
  });
});
