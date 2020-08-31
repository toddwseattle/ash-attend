import $ from "jquery";
import { ClassGrid, getClassTimeToString } from "../classgrid";
global.$ = $;
describe('ClassGrid Tests', () => {
    describe('basic properties exist after constructed', () => {
        let cg; 
        beforeEach(() => {
            cg = new ClassGrid();
        });
        test("should have an ClassGrid Class", () => {
            expect(ClassGrid).toBeTruthy();
          });
        test("should initialize with an empty constructor", () => {
            expect(cg).toBeTruthy();
        });
        it('should have a default id of class grid ', () => {
            expect(cg.id).toEqual("class-grid");
        });
        it('should have a jquery property', () => {
            expect(cg.jquery).toBeTruthy();
        });
        it('should have a table container',()=>{
            expect(cg.tableContainer).toBeTruthy();
        });
        it('should have a header Element',()=>{
            expect(cg.headerElement).toBeTruthy();
        });
        it('should have a row Element',()=>{
            expect(cg.rowElement).toBeTruthy();
        });        
        it('should have an item Element',()=>{
            expect(cg.itemElement).toBeTruthy();
        });   
        it('should have an empty classes element', () => {
            expect(cg.classes.length).toEqual(0);
        });
        it('should have default columns', () => {
            expect(cg.columns.length).toBeTruthy();
        });     
        
    });
    describe('the getHeaders method should get default headers', () => {
        let cg;
        let hr;
        beforeEach(() => {
            cg = new ClassGrid();
            hr = cg.getHeaders();
        });
        test("should return an object", () => {
            expect(typeof hr).toBe("object");
          });
        test("should return an DOM node with # children==columns", () => {
        expect(hr.childNodes.length).toBe(cg.columns.length);
        });
        test("should create ids based on the keys for the children", () => {
            hr.childNodes.forEach((v, i) => {
              expect(v.id).toBe(`${cg.id}-${cg.columns[i].key}-hd`);
            });
          });
        test("should have the labels in each node", () => {
            hr.childNodes.forEach((v, i) => {
              expect(v.innerHTML).toBe(cg.columns[i].label);
            }); 
        });
    });
    describe('A table works with a couple of rows', () => {
        let cg;
        let cls;
        beforeEach(() => {
            cls = [
                {class_date: new Date("2020-09-14 16:45"), class_name:"Monday Test Class"},
                {class_date: new Date("2020-09-21 16:45"), class_name:"Monday Test Class"},
        ];
         cg = new ClassGrid(cls,$);
        });
        it('should have a classes property with 2 classes', () => {
            expect(cg.classes.length).toEqual(2);
        });
        it('should getRow(0) should return a 0th row', () => {
            const row0 = cg.getRow(0);
            expect(typeof row0==='object').toBeTruthy();
        });
        it('should have an element for each column in the 0th row', () => {
            const row0 = cg.getRow(0);
            expect(row0.children.length).toEqual(cg.columns.length);
        });
        it('should have the right date for the 0th row', () => {
            const row0 = cg.getRow(0);
            const rowData0 = cg.classes[0];
            const foo = document.getElementById('foo');
            for (let i = 0; i < row0.children.length; i++) {
                const data = rowData0[cg.columns[i].key];
                expect(row0.children.item(i).innerText).toEqual(getClassTimeToString(data));
            }
        });
        describe('getTable should work', () => {
            let cg;
            let cls;
            let tt;
            beforeEach(() => {
                cls = [
                    {class_date: new Date("2020-09-14 16:45"), class_name:"Monday Test Class"},
                    {class_date: new Date("2020-09-21 16:45"), class_name:"Monday Test Class"},
            ];
             cg = new ClassGrid(cls,$);
             tt = cg.getTable();
            });
            it('should return an object when getTable is called', () => {
                const tableElem = cg.getTable();
                expect(tableElem instanceof Element).toBeTruthy();
                
            });
            it('should return a table element that has the tableContainer at the top', () => {
                const tc = cg.tableContainer;
                expect(tt.tagName).toEqual(tc.tagName);
            });
            it('should return a table with child elements', () => {
                expect(tt.children.length).toBeGreaterThanOrEqual(1);
            });
            it('should have a header + an element for each row as children', () => {
                expect(tt.children.length).toEqual(cls.length+1);                
            });
            it('should have a header in the first row', () => {
                expect(tt.children[0].tagName).toEqual(cg.headerElement.tagName);
            });
            it('should create a row for each class passed to the grid', () => {
                cls.forEach((cls,i)=> {
                    expect(tt.children[1+i].tagName).toEqual(cg.rowElement.tagName);
                })
            });
        });
    });
        
});