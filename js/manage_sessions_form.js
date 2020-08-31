/**
 * This file contains supporting information for the manage_session form
 * Including field data; and main methods for different buttons.
 * 
 */
export function generateSessions({start,time,description,dayMap,length}) {
    const weekday = new Array(7);
    weekday[0]="Monday";
    weekday[1]="Tuesday";
    weekday[2]="Wednesday";
    weekday[3]="Thursday";
    weekday[4]="Friday";
    weekday[5]="Saturday";
    weekday[6]="Sunday";
    const msPerDay = 24 * 60 * 60 * 1000; // Number of milliseconds per day
    if( length===0) return([]);
     else if((length>0)&&start&&time&&description) {
        // in the case of no dayMap; just generate a single event without a day in the description
        const eventTime = new Date(`${start} ${time}`);
        if(!dayMap&&(length===1)) {

            return [{class_date: eventTime, class_name: `${description}`}];
        } else {
            // generate a bunch of events
            const classArray=[];

            for (let weekNum = 0; weekNum < length; weekNum++) {
               const weekStart = new Date(eventTime.getTime()+msPerDay*7*weekNum);
               for(const day in dayMap) {
                if(dayMap[day]) {
                    const dayNum=weekday.findIndex(d => d===day);
                    classArray.push({
                        class_date: new Date(weekStart.getTime()+dayNum*msPerDay),
                        class_name: `${weekday[dayNum]} ${description}`
                    });
                }
               }
            }
            return classArray;
        }
     } 
     else {
    throw("Bad Parameters to generateSessions");
}
}
 /**
 * validation functions
 */
function checkBasicText(text) {
    return text && text.length > 0 ? text : null;
  }
  function checkNumberNotZero(num) {
    return +num > 0 ? +num : null;
  }
  function checkbox(check) {
    return check;
  }
  function dateCheck(check) {
    let value = null;
    const d = new Date(check);
    if (d) {
       value = (d.getUTCDay()===1 && d.valueOf() > Date.now()) ? d : null;
    }
    return value ? check :null;
  }
  function checkTime(value){
    return value;
  }
  
 /**
  * fields definition
  */
 export const createSessionsFields = [
    {
      id: "#description",
      check: checkBasicText,
      description: "Session Description",
      invalidMessage: "Must not be blank",
      name: "description",
      minCheck: 1,
    },
    {
      id: "#repeat",
      check: checkNumberNotZero,
      description: "Number of Sessions to Generate",
      invalidMessage: "Must be at least 1",
      name: "repeat",
      minCheck: 0,
    },
    {
      id: "#start",
      description: "When to start",
      check: dateCheck,
      invalidMessage: "Should be a monday in the future",
      name: "start",
    },
    {
      id: "#Monday",
      check: checkbox,
      description: "Occurs on Monday",
      invalidMessage: "",
      name: "Monday",
    },
    {
      id: "#Tuesday",
      check: checkbox,
      description: "Occurs on Tuesday",
      invalidMessage: "",
      name: "Tuesday",
    },
    {
      id: "#Wednesday",
      check: checkbox,
      description: "Occurs on Wednesday",
      invalidMessage: "",
      name: "wednesday",
    },
    {
      id: "#Thursday",
      check: checkbox,
      description: "Occurs on Thursday",
      invalidMessage: "",
      name: "Thursday",
    },
    {
      id: "#Friday",
      check: checkbox,
      description: "Occurs on Friday",
      invalidMessage: "",
      name: "Friday",
    },
    {
      id:"#classtime",
      check: checkTime,
      description: "Time Class begins",
      invalidMessage:"Invalid Time for class beginning",
      name:"classtime",
    }
  ];