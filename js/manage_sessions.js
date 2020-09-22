/**
 * manage sessions javascript
 */
import {
  FormValidation,
  checkEmailAndClean,
  validDomains,
  FormError,
} from "./form_validation.js";
import { createSessionsFields, generateSessions } from "./manage_sessions_form.js";
import { ClassGrid} from "./classgrid.js";
import { addToMySQLFormat, convertToMySQLDates } from "./dateHelpers.js";

/**
 * looks for Form interdependent field validation issues
 * @param {FormValidation} currentForm
 */
function checkDayChecked(form) {
  const checkDays = ["Monday","Tuesday","Wednesday","Thursday","Friday"];
  let hasDay = false;
  checkDays.forEach(day=>{
    hasDay = hasDay || form.jquery("#"+day).prop("checked");
  })
  return hasDay;
}
/**
 * 
 * @param {jquery event} event 
 * @param {*} sessGenValid 
 */
function generateSessionsClick(event,sessGenValid,classesToGen) {
  const value=sessGenValid.values;
  const toCreate = {
    start: value.start,
    description: value.description,
    time: value.classtime,
    length: value.repeat
  }
  let dayMap = {}
  dayMap["Monday"] = value["Monday"];
  dayMap["Tuesday"] = value["Tuesday"];
  dayMap["Wednesday"] = value["Wednesday"];
  dayMap["Thursday"] = value["Thursday"];
  dayMap["Friday"] = value["Friday"];
  toCreate.dayMap = dayMap;
  const sessGen = generateSessions(toCreate);  
  const grid = new ClassGrid(sessGen);
  const stcElement = $("#sessions-to-create");
  stcElement.empty();
  stcElement.show();
  stcElement.append(grid.getTable());
  classesToGen.new_classes = sessGen;
  $("#submit").prop('disabled',false);
}

function add_classes(classActions) {
  const sqlClasses = {new_classes: convertToMySQLDates(classActions.new_classes)};
  return new Promise((resolve,reject)=>{
    $.post("../actions/add_classes_action.php",sqlClasses)
        .done(data=>resolve(data))
        .fail(error=> reject(error));
  })
}
function generateSuccess(generatedClasses) {
  const testCount = generatedClasses.new_classes.length;
  const successMessage = `<p>${testCount} classes generated</p>`;
  const generateArea = $("#sessions-to-create");
  generateArea.empty();
  generateArea.append(successMessage);

}
function submitButtonClick(event,classesToGen) {
  
  event.preventDefault();
  add_classes(classesToGen).then(result => {
    if(result==='success') {
      generateSuccess(classesToGen);
    }
    console.table(result);
  });
}
$(() => {
  
    
    const sessGenValid = new FormValidation({fields:createSessionsFields,submitButtonId:"#generate"});
    sessGenValid.addFormValidatorFunction({
      func:checkDayChecked,
      message:"Need to select a day classes occur"
    });
    const submitButton = $('#submit')
    let classesToGen={new_classes:[]};
    submitButton.prop('disabled',true);
    submitButton.on('click',(event) => {submitButtonClick(event,classesToGen)})

    $("#gen-form").on("change", sessGenValid.updateFromChange);
    $("#generate").on('click',(event)=>{generateSessionsClick(event,sessGenValid,classesToGen)});
    
  });
