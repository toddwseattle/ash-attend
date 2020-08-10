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
describe("headers are created and managed properly work properly", () => {
  let columns = [];
  let tbl = {};
  let hr = {};
  beforeEach(() => {
    columns = [
      { key: "key1", label: "label1" },
      { key: "key2", label: "label2" },
      { key: "key3", label: "label3" },
    ];
    tbl = new htmlTable(columns);
    hr = tbl.getHeaders();
  });
  test("should return an object", () => {
    expect(typeof hr).toBe("object");
  });
  test("should return an DOM node with # children==columns", () => {
    expect(hr.childNodes.length).toBe(columns.length);
  });
  test("should create ids based on the keys for the children", () => {
    hr.childNodes.forEach((v, i) => {
      expect(v.id).toBe(`${tbl.id}-${columns[i].key}-hd`);
    });
  });
  test("should have the labels in each node", () => {
    hr.childNodes.forEach((v, i) => {
      expect(v.innerHTML).toBe(columns[i].label);
    });
  });
});
describe("the table should return rows of values", () => {
  beforeEach(() => {
    columns = [
      { key: "key1", label: "label1" },
      { key: "key2", label: "label2" },
      { key: "key3", label: "label3" },
    ];
    values = [
      {
        key1: "row-1-key-1",
        key2: "row-1-key-2",
        key3: "row-1-key-3",
      },
      {
        key1: "row-2-key-1",
        key2: "row-2-key-2",
        key3: "row-2-key-3",
      },
      {
        key1: "row-3-key-1",
        key2: "row-3-key-2",
        key3: "row-3-key-3",
      },
      {
        key1: "row-4-key-1",
        key2: "row-4-key-2",
        key3: "row-4-key-3",
      },
      {
        key1: "row-5-key-1",
        key2: "row-5-key-2",
        key3: "row-5-key-3",
      },
      {
        key1: "row-6-key-1",
        key2: "row-6-key-2",
        key3: "row-6-key-3",
      },
    ];
    tbl = new htmlTable(columns);
    tbl.values = values;
  });
  test("should be able to get the first row with an element for each key", () => {
    expect(tbl.getRow(0).childNodes.length).toBe(Object.keys(values[0]).length);
  });
  test("should be able to have all the correct values in the first row", () => {
    tbl.getRow(0).childNodes.forEach((v, i) => {
      expect(v.innerHTML).toBe(values[0][Object.keys(values[0])[i]]);
    });
  });
});
