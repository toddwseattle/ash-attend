import { ClassGrid} from "./classgrid.js";
import { addToMySQLFormat, convertToMySQLDates } from "./dateHelpers.js";

$(()=>{
if(typeof upComing!== 'undefined') {
    const upComingGrid = new ClassGrid(upComing);
    const upcomingDiv = $("#upcoming-div");
    upcomingDiv.empty();
    upcomingDiv.append(upComingGrid.getTable());
}
});