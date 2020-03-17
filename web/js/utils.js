

function compareTwoArrays(array1, array2) {

    for (var i = array1.length - 1; i >= 0; i--) {
        for (var j = 0; j < array2.length; j++) {
            if (array1[i] === array2[j]) {
                array1.splice(i, 1);
            }
        }
    }
    return array1;
    // console.log(array1);
}

// https://stackoverflow.com/questions/8562583/add-element-to-array-associative-arrays
function compareTwoAssotiativeArrays(myArray, toRemove) {
    for (var i = myArray.length - 1; i >= 0; i--) {
        for (var j = 0; j < toRemove.length; j++) {
            if (myArray[i] && (myArray[i].ids === toRemove[j].ids)) {
                myArray.splice(i, 1);
            }
        }
    }
    return myArray;
}

