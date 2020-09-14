/**
 * Helper functions for dates
 */


/**
 * factory function that adds toMySQLFormat method to the Date type
 **/
export function addToMySQLFormat() {
Date.prototype.toMySQLFormat = function() {
    return this.toISOString().slice(0, 19).replace('T', ' ')
};
}

export function convertObjectDatesToMySQL(obj) {
    let newObj = {};
    addToMySQLFormat();
    if(typeof obj==='object'){
    for (const key in obj) {
        if (obj.hasOwnProperty(key)) {
            if(obj[key] instanceof Date)
            {
                newObj[key]= obj[key].toMySQLFormat();
            } else {
                newObj[key] = obj[key];
            }
            
        }
    }
    return newObj;
} else if(obj instanceof Date) {
    return obj.toMySQLFormat();
} else throw(`convertObjectDatesToMySQL Failed did not pass an object passed a ${typeof obj}`);
}

export function convertArrayOfObjectToMySQL(arr) {
    if(Array.isArray(arr)) {
        const newArray = [];
        arr.forEach(v => {
            newArray.push(convertToMySQLDates(v));
        })
        return newArray;
    } else throw (`convertArryOfObjectToMySQL Failed. Did not pass an array` );
}

export function convertToMySQLDates(something) {
    if(Array.isArray(something)) {
        return convertArrayOfObjectToMySQL(something);
    } else if(typeof something==='object') {
        return convertObjectDatesToMySQL(something);
    } else throw(`convertToMySQLDates only works on arrays and objects, was passed a ${typeof something}`);
}