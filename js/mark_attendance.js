const CLASS_DURATION = 90;
const MINUTES_BEFORE_CLASS = 5;
const MINUTES_AFTER_CLASS = 10;
const ONE_MINUTE = 1000*60;
function makeToolTip(tipText,id) {
    if(!id) {
    return `<span class=\"tooltip\">${tipText}</span>`;
    } else {
        return `<span class=\"tooltip\" id="${id}">${tipText}</span>`;
    }
}
$(()=>{
    const presentCheck = $("#mark-present");
    const markDateElement = $("#mark-date");
    // This page depends on PHP defining a global with the upcoming
    // date  see mark_attendance.php
    let attendanceEnabled = false;
    if(typeof upComing!=="undefined") {
        console.log(upComing);
        const upcomingTime = new Date(upComing.class_date+" UTC");
        const attendanceStart = upcomingTime.valueOf() - MINUTES_BEFORE_CLASS * ONE_MINUTE;
        const attendanceEnd = upcomingTime.valueOf() + (MINUTES_AFTER_CLASS+CLASS_DURATION) * ONE_MINUTE;
        attendanceEnabled = ((new Date()).valueOf() > attendanceStart )&& ((new Date()).valueOf() < attendanceEnd);
    } else {
    
        console.log("upcoming not defined");
    }
    if(attendanceEnabled) {
        presentCheck.removeAttr("disabled");
        $("#check-wrapper").removeClass("disabled-check");
        markDateElement.remove("#mark-tip");
        markDateElement.append(makeToolTip("Mark Present for class by clicking the checkbox and submitting","mark-tip"));
    } else {
       presentCheck.attr("disabled",true);
       $("#check-wrapper").addClass("disabled-check");
       markDateElement.remove("#mark-tip");
       markDateElement.append(makeToolTip(`You can only mark attendance ${MINUTES_BEFORE_CLASS} minutes before class to ${MINUTES_AFTER_CLASS} after`,"mark-tip")); 
    }
    console.log("ready");
});