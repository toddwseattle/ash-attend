/**
 * HTMLTable - creates an HTML Table and the backing data.   Pass a
 * list of column headers to the constructor; or an object with a key and label property.
 */
class HTMLTable {
  id = "table"; // should be the html id of the table
  columns = []; // will be an array of objects {key, label}
  headerElement = document.createElement("th");
  rowElement = document.createElement("tr");
  itemElement = document.createElement("td");
  constructor(headers) {
    if (Array.isArray(headers) && headers.length > 0) {
      if (typeof headers[0] === "string") {
        headers.forEach((h) => {
          this.columns.push({ key: h, label: h });
        });
      } else if (
        headers[0].hasOwnProperty("key") &&
        headers[0].hasOwnProperty("label")
      ) {
        headers.forEach((h) => {
          this.columns.push(h);
        });
      }
    }
  }
  getHeaders() {
    headerRow = this.headerElement;
    this.columns.forEach((col) => {
      const colEl = this.itemElement.cloneNode(false);
      colEl.innerHTML = col.label;
      this.headerRow.appendChild();
    });
    return headerRow;
  }
}
module.exports = HTMLTable;
