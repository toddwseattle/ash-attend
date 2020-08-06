const htmltable = require("../src/utility/managetable");
describe("basic HTMLTable Class Tests", () => {
  test("should have an HTMLTable Class", () => {
    expect(htmltable).toBeTruthy();
  });
  test("should initilize with an empty constructor", () => {
    const t = new htmltable();
    expect(t.id).toBe("table");
  });
});
