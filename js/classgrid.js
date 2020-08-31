
export function getClassTimeToString(d) {
    if(d instanceof Date) {
        const options ={month: 'short', day: 'numeric', year:'numeric', hour:'numeric', minute:'numeric', hour12: false };
        return d.toLocaleString(undefined,options);    
    }else {
        return d.toString();
    }
}
/**
 * Create a reusable grid of classes client side.  pass an array of classes.  each
 * class has the following structure minimum {class_date, class_name}
 * 
 * an optional parameter for the jquery library.  assumes $ is defined if it's not there
 * dependent on document in the global namespace
 */
 export class ClassGrid {
    constructor(classes,jquery) {
        this.id = "class-grid";
        this.jquery = jquery ? jquery : $;
        this.tableContainer = document.createElement("table");
        this.headerElement = document.createElement("th");
        this.rowElement = document.createElement("tr");
        this.itemElement = document.createElement("td");
        this.classes = classes ? classes : [];
        this.columns = [{key: 'class_date', label:"Date"},
        {key: 'class_name', label:"Name"}];
    }
    getHeaders() {
        const headerRow = this.headerElement.cloneNode(false);
        this.columns.forEach((col) => {
          const colEl = this.itemElement.cloneNode(false);
          colEl.id = `${this.id}-${col.key}-hd`;
          colEl.innerHTML = col.label;
          headerRow.append(colEl);
        });
        return headerRow;
      }
      getRow(i) {
        const row = this.rowElement.cloneNode(false);
        if (i < this.classes.length) {
          this.columns.forEach((col) => {
            const colEl = this.itemElement.cloneNode(false);
            colEl.id = `${this.id}-${col.key}-${i}`;
            let value = this.classes[i][col.key] ? this.classes[i][col.key] : "";
            if(value instanceof Date) {
                value = getClassTimeToString(value);
            }
            colEl.innerText = value;
            row.append(colEl);
          });
        }
        return row;
      }
      getTable() {
          const newTable = this.tableContainer.cloneNode(false);
          newTable.appendChild(this.getHeaders());
          this.classes.forEach((cl,i)=> {
              newTable.appendChild(this.getRow(i));
          });
          return newTable;
      }
}
