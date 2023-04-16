function admSelectCheck(nameSelect, addValues, admOptionValue)
{
    /**
    * Function to show and hide elements when selecting options from a checkbox
    * @version 1.1
    * @param {string} nameSelect Selection(<select> html tag) to be read
    * @param {boolean} addValues Sets whether to read more forms/selections, if true allows to read 2 more selections
    * @param {string} admOptionValue Form/Select Id
    */
    // If nameSelect is set, it checks if it is equal to the id of the selection.
    if(nameSelect){
        admOptionValue = document.getElementById("option").value;
        if(admOptionValue == nameSelect.value){
            // If it is shows the element
            document.getElementById("element").style.display = "block";
        }
        else{
            // Otherwise, hides it
            document.getElementById("element").style.display = "none";
        }
    }
    else {
        // If nameSelect is not set, also hides the element
        document.getElementById("element").style.display = "none";
    }    
    if (addValues == true){
        // If addValues is true, it reads the id of the selection and checks if it is equal to the id of the selection
        admOptionValue2 = document.getElementById("option2").value;
        admOptionValue3 = document.getElementById("option3").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("element2").style.display = "block";
        }
        else{
            document.getElementById("element2").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("element3").style.display = "block";
        }
        else{
            document.getElementById("element3").style.display = "none";
        }
    }
    else{
    document.getElementById("element2").style.display = "none";
    document.getElementById("element3").style.display = "none";
    }
}
function admSelectCheck2(nameSelect, addValues, admOptionValue)
{
    /**
    * Function to show and hide elements when selecting options from a checkbox
    * @version 1.1
    * @param {string} nameSelect Selection(<select> html tag) to be read
    * @param {boolean} addValues Sets whether to read more forms/selections, if true allows to read 2 more selections
    * @param {string} admOptionValue Form/Select Id
    */
    // If nameSelect is set, it checks if it is equal to the id of the selection.
    if(nameSelect){
        admOptionValue = document.getElementById("option4").value;
        if(admOptionValue == nameSelect.value){
            // If it is the same, it shows the element you want to show
            document.getElementById("element4").style.display = "block";
        }
        else{
            // Otherwise, hide the element
            document.getElementById("element4").style.display = "none";
        }
    } 
    // If nameSelect is not set, it also hides the element
    else {
        document.getElementById("element4").style.display = "none";
    }
    // Repeats the same process as above for adding values, but duplicated 
    if (addValues == true){
        admOptionValue2 = document.getElementById("option5").value;
        admOptionValue3 = document.getElementById("option6").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("element5").style.display = "block";
        }
        else{
            document.getElementById("element5").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("element6").style.display = "block";
        }
        else{
            document.getElementById("element6").style.display = "none";
        }
    }
    else{
    document.getElementById("element5").style.display = "none";
    document.getElementById("element6").style.display = "none";
    }
}
function admSelectCheck3(nameSelect, addValues, admOptionValue)
{
    /**
    * Function to show and hide elements when selecting options from a checkbox
    * @version 1.1
    * @param {string} nameSelect Selection(<select> html tag) to be read
    * @param {boolean} addValues Sets whether to read more forms/selections, if true allows to read 2 more selections
    * @param {string} admOptionValue Form/Select Id
    */
    // If nameSelect is set, it checks if it is equal to the id of the selection.
    if(nameSelect){
        admOptionValue = document.getElementById("option7").value;
        if(admOptionValue == nameSelect.value){
            // If it is the same, it shows the element you want to show
            document.getElementById("element7").style.display = "block";
        }
        else{
            // Otherwise, hide the element
            document.getElementById("element7").style.display = "none";
        }
    }
    // If nameSelect is not set, it also hides the element
    else {
        document.getElementById("element7").style.display = "none";
    }    
    // Repeats the same process as above for adding values, but duplicated
    if (addValues == true){
        admOptionValue2 = document.getElementById("option8").value;
        admOptionValue3 = document.getElementById("option9").value;
        if(admOptionValue2 == nameSelect.value){
            document.getElementById("element8").style.display = "block";
        }
        else{
            document.getElementById("element8").style.display = "none";
        }
        if(admOptionValue3 == nameSelect.value){
            document.getElementById("element9").style.display = "block";
        }
        else{
            document.getElementById("element9").style.display = "none";
        }
    }
    // If addValues is false, it hides the elements
    else{
    document.getElementById("element8").style.display = "none";
    document.getElementById("element9").style.display = "none";
    }
}