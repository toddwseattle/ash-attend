const { addToMySQLFormat, convertObjectDatesToMySQL, convertArrayOfObjectToMySQL } = require("../dateHelpers");
const datePairs = [
    {js: "10/10/2010 10:10 UTC", sql:"2010-10-10 10:10:00" },
    {js: "10/10/2020 20:10 UTC", sql:"2020-10-10 20:10:00" },
    {js: "9/9/2010 9:10 UTC", sql:"2010-09-09 09:10:00" },
]
describe('date helper tests', () => {
    describe('addToMySQLFormat function modifies Date by adding toMySQLFormat', () => {
        it('should add a function toMYSQLFormat', () => {
            addToMySQLFormat();
            expect(Date.toMySQLFormat!=='undefined').toBeTruthy();    
        });
        it('should convert a basic date', () => {
            addToMySQLFormat();
            const d =  new Date("10/10/2010 10:10 UTC")
            const sqlD = d.toMySQLFormat();
            expect(sqlD).toEqual("2010-10-10 10:10:00");
        });
        it('should convert single digit month and day', () => {
            addToMySQLFormat();
            const d = new Date("9/9/2020 9:00 UTC");
            const sqlD = d.toMySQLFormat();
            expect(sqlD).toEqual("2020-09-09 09:00:00");
        });
    });
    describe('covertObjectDatesToMySql works with objects', () => {
        let obj;
        let sqlObj;
        beforeEach(() => {
            obj = {date: new Date(datePairs[0].js), numb: 1, str: "string", obj: {numb:1, string: "string" }};
            sqlObj = convertObjectDatesToMySQL(obj);
        });
        it('should return an object', () => {   
            expect(typeof sqlObj==='object').toBeTruthy();
        });
        it('should have all the keys of the passed in object', () => {
            let hasKeys = true;
            for (const key in obj) {
                if (obj.hasOwnProperty(key)) {
                     hasKeys =hasKeys && sqlObj[key];
                }
            }
            expect(hasKeys).toBeTruthy();
        });
        it('should convert the date to a sql date', () => {
            expect(sqlObj.date).toEqual(datePairs[0].sql);
        });
    });
    describe('convertArrayOfObjectToMySql works on arrays', () => {
        let arr;
        let sqlArr;
        beforeEach(() => {
            arr = [];
            datePairs.forEach((dp,i) => {
                arr.push({id: i, date: new Date(dp.js), str: `string ${i}` })
            });
            sqlArr = convertArrayOfObjectToMySQL(arr);
        });
        it('should have an array of the same length as that passed in', () => {
            expect(sqlArr.length).toEqual(arr.length);
        });
        it('should convert each date', () => {
            let dateGood = true;
            sqlArr.forEach((v,i)=> {
                console.log(v.date, datePairs[i.sql]);
                dateGood=dateGood && (v.date===datePairs[i].sql);
            });
            expect(dateGood).toBeTruthy();
        });
    });
});