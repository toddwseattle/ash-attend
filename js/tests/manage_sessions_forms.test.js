const { generateSessions } = require("../manage_sessions_form");
const msPerDay = 24 * 60 * 60 * 1000; // Number of milliseconds per day

describe('generate sessions', () => {
    let gs;
    it('should throw an error with bad parameters', () => {
        expect(() => {
            generateSessions({});
        }).toThrow("Bad Parameters to generateSessions"); 

    });
    it('should generate an empty array if the length is 0', () => {
        const newClasses= generateSessions({length:0});
        expect(newClasses.length).toEqual(0);
    });
    describe('should handle a single event', () => {
        let newClass;
        beforeEach(() => {
            gs = {start:"2020-09-14", time:"15:45",description:"Test Class",length:1}
            newClass = generateSessions(gs);
        });
     it('should generate a single class', () => {
            expect(newClass.length).toEqual(1);
        });
        it('the single member should have a class_date property that is a valid dateTime', () => {
            expect(newClass[0].class_date).toEqual(new Date(`${gs.start} ${gs.time}`));
        });
        it('the single member should have a class_name that includes the description', () => {                
            expect(newClass[0].class_name.indexOf(gs.description)).toBeGreaterThanOrEqual(0);
        });
    });    
    describe('should handle two weeks with one day', () => {
        let newClasses;
        beforeEach(() => {
            gs = {start:"2020-09-14", time:"15:45",description:"Test Class",length:2, dayMap:{"Monday":true}};
            newClasses = generateSessions(gs);
        });
        it('should create 2 classes', () => {
            expect(newClasses.length).toEqual(2);
        });
        it('should have class_date properties on each array member', () => {
            newClasses.forEach(cl =>{
                expect(cl.class_date).toBeTruthy();
            });
        
        });
        it('should have class_name properties on each array member', ()=>{
            newClasses.forEach(cl => {
                expect(cl.class_name).toBeTruthy();
            });
        });
        it('should have "Monday" in each member', () => {
            newClasses.forEach(cl => {
                expect(cl.class_name.indexOf("Monday")>=0).toBeTruthy();
            });
        });
        it('should create the first entry equal to the start date', () => {
            const firstMonday = new Date(`${gs.start} ${gs.time}`);
            expect(newClasses[0].class_date).toEqual(firstMonday);
        });
        it('should create the 2nd entry a week later than the start', () => {
            const firstMonday = new Date(`${gs.start} ${gs.time}`);
            expect(newClasses[1].class_date.getTime()).toEqual(firstMonday.getTime()+msPerDay*7);
        });
        });
    describe('should handle two weeks with two days', () => {
        let newClasses;
        beforeEach(() => {
            gs = {start:"2020-09-14", time:"15:45",description:"Test Class",length:2, dayMap:{"Monday":true,"Wednesday":true}};
            newClasses = generateSessions(gs);
        });
        it('it should have 4 classes', () => {
            expect(newClasses.length).toEqual(4);
        });
        it('should have 2 mondays', () => {
            let numMondays = 0;
            newClasses.forEach(cl => {
                if(cl.class_date.getUTCDay()===1) 
                {
                    numMondays++;
                }
            });
            expect(numMondays).toEqual(2);
        });
        it('should have 2 wednesdays', () => {
            let numWednesdays = 0;
            newClasses.forEach(cl => {
                if(cl.class_date.getUTCDay()===3) 
                {
                    numWednesdays++;
                }
            });
            expect(numWednesdays).toEqual(2);
        });


    });

});