function setTextFromId(id, newvalue) {
    const s = document.getElementById(id);
    if (s !== null) {
        s.innerHTML = newvalue;
    } else {
        console.log(`unable to set text ${newvalue} in element ${id}, it is null`);
    }
}
