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
  values = [];
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
    if (i < this.values.length) {
      this.columns.forEach((col) => {
        const colEl = this.itemElement.cloneNode(false);
        colEl.id = `${this.id}-${col.key}-${i}`;
        colEl.innerHTML = this.values[i][col.key]
          ? this.values[i][col.key]
          : "";
        row.append(colEl);
      });
    }
    return row;
  }
}
module.exports = HTMLTable;
