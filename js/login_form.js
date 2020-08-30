// file assume jquery in global scope
import {
  FormValidation,
  checkEmailAndClean,
  validDomains,
  FormError,
} from "./form_validation.js";

const loginFormField = [
  {
    id: "#email",
    check: checkEmailAndClean,
    description: "Ashesi Email",
    invalidMessage: "Email Must be a Valid Ashesi Email",
    name: "email",
    isValid: false,
    isDirty: false,
  },
];
function check_login(email) {
  return new Promise((resolve, reject) => {
    $.post("../actions/login_action.php", email)
      .done((data) => resolve(data))
      .fail((error) => reject(error));
  });
}
function process_fields(event, loginForm) {
  event.preventDefault();
  const resultErrs = [
    new FormError({ id: "success", message: "Login Successful" }),
    new FormError({ id: "pending", message: "Login is pending approval" }),
    new FormError({ id: "failed", message: "Login failed" }),
  ];
  const values = loginForm.values;
  check_login(values).then((response) => {
    let result_code = response && response.result ? response.result : response;
    let url = response && response.url ? response.url : "/";
    const resultErr = resultErrs.find((err) => result_code == err.id);
    if (resultErr) {
      loginForm.formResultsMessage(resultErr);
    } else {
      loginForm.formResultsMessage("Unknown result from Login ?");
    }
    if (result_code == "success") {
      window.location.href = url;
    }
  });
}

$(document).ready(() => {
  const loginFormField = [
    {
      id: "#email",
      check: checkEmailAndClean,
      description: "Ashesi Email",
      invalidMessage: "Email Must be a Valid Ashesi Email",
      name: "email",
      isValid: false,
      isDirty: false,
    },
  ];
  const loginFormValidation = new FormValidation(
    loginFormField,
    "#loginSubmit"
  );

  $("#loginForm").on("change", loginFormValidation.updateFromChange);
  $("#loginForm").on("submit", (event) => {
    process_fields(event, loginFormValidation);
  });
});
