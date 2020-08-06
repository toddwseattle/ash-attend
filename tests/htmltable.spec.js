const htmlTable = require("../src/utility/managetable");
describe("basic HTMLTable Class Tests", () => {
  test("should have an HTMLTable Class", () => {
    expect(htmlTable).toBeTruthy();
  });
  test("should initialize with an empty constructor", () => {
    const t = new htmlTable();
    expect(t.id).toBe("table");
  });
  describe("should be able to initialize a table with just an array of strings", () => {
    let headers = [];
    let tbl = {};
    beforeEach(() => {
      headers = ["col1", "col2", "col3"];

      tbl = new htmlTable(headers);
    });
    test("the array of columns should have the same length as headers", () => {
      expect(tbl.columns.length).toBe(headers.length);
    });
    test("each column should have a key and label that match headers", () => {
      tbl.columns.forEach((col, index) => {
        expect(col.key).toBe(headers[index]);
        expect(col.label).toBe(headers[index]);
      });
    });
  });
  describe("initialize a table with keys and labels", () => {
    let columns = [];
    let tbl = {};
    beforeEach(() => {
      columns = [
        { key: "key1", label: "label1" },
        { key: "key2", label: "label2" },
        { key: "key3", label: "label3" },
      ];
      tbl = new htmlTable(columns);
    });
    test("the array of columns should have the same length as the columns pass", () => {
      expect(tbl.columns.length).toBe(columns.length);
    });
    test("each column should have a key and label that match columns array passed in", () => {
      tbl.columns.forEach((col, index) => {
        expect(col.key).toBe(columns[index].key);
        expect(col.label).toBe(columns[index].label);
      });
    });
  });
});
