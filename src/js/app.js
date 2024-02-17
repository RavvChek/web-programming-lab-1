function validateX() {
    let el = document.querySelector('select[id=x]')
    let selectedEl = el.options[el.selectedIndex].value
    switch (selectedEl) {
        case '-4':
            console.log("X is selected equal -4");
            return true
        case '-3':
            console.log("X is selected equal -3");
            return true
        case '-2':
            console.log("X is selected equal -2");
            return true
        case '-1':
            console.log("X is selected equal -1");
            return true
        case '0':
            console.log("X is selected equal 0");
            return true
        case '1':
            console.log("X is selected equal 1");
            return true
        case '2':
            console.log("X is selected equal 2");
            return true
        case '3':
            console.log("X is selected equal 3");
            return true
        case '4':
            console.log("X is selected equal 4");
            return true
        default:
            console.log("No value selected");
            return false;
    }
}


function validateY() {
    let el = document.querySelector('y')
    let y = el.value.replace('.', ',')
    if (isNum(y) || parseFloat(y) >= -3 || parseFloat(y) <= 5) {
        el.setCustomValidity("")
        return true;
    } else {
        el.setCustomValidity("Please enter an integer between -3 and 3");
        el.reportValidity();
        return false
    }
}

function validateR() {
    let checkboxes = document.querySelectorAll('input[type=checkbox]')
    console.log('r_check')
    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            return true;
        }
    }
    checkboxes[4].setCustomValidity("Please choose box");
    checkboxes[4].reportValidity();
    return false;
}

function validateAll() {
    return validateX() & validateY() & validateR();
}

function isNum(n) {
    return isFinite(n) && !isNaN(parseFloat(n));
}

// const clearTableButton = document.getElementById('clean-table-button');
// const tableBody = document.querySelector('table tbody');
//
// clearTableButton.addEventListener('click', () => {
//     tableBody.innerHTML = '';
// });


