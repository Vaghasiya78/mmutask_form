function form_validation() {

    // define all variables which store form data
    const error = [];
    returnval = true;
    let eid = document.forms.empForm.eid.value;
    let ename = document.forms.empForm.ename.value;
    let email = document.forms.empForm.email.value;
    let salary = document.forms.empForm.salary.value;
    let department = document.forms.empForm.department.value;
    let lang = document.forms.empForm.lang.value;
    let profilepic = document.forms.empForm.uploadfile.value;
    let description = document.forms.empForm.description.value;
    let joiningdate = document.forms.empForm.joiningdate.value;
    let hobby_array = document.getElementsByName("hobby[]");
    let hobby = false;

    // checkbox is checked or not
    for (k = 0; k < hobby_array.length; k++) {
        if (hobby_array[k].checked) {
            hobby = true;
            break;
        }
    }

    // check Validation for form
    if (ename == "" || !isNaN(ename)) {
        error.push("This employee name is empty please insert some data.");
        document.getElementById("ename").focus();
        returnval = false;
    } else if (!/^[A-Za-z\s]+$/.test(ename)) {
        error.push("Only alphabets and whitespace are allowed in employee field.");
        document.getElementById("ename").focus();
        returnval = false;
    }

    if (email == "" || !isNaN(email)) {
        error.push("This employee email is empty please insert some data.");
        document.getElementById("email").focus();
        returnval = false;
    } else if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
        error.push("Email is not valid please enter valid email.");
        document.getElementById("email").focus();
        returnval = false;
    }

    if (salary == "") {
        error.push("This employee salary is empty please insert some data.");
        document.getElementById("salary").focus();
        returnval = false;
    } else if (!/^[0-9]+$/.test(salary)) {
        error.push("Only numeric value is allowed in salary.");
        document.getElementById("salary").focus();
        returnval = false;
    } else if ((salary.length) >= 7) {
        error.push("Enter Salary value is less then 6 character.");
        document.getElementById("salary").focus();
        returnval = false;
    }

    if (department == "" || !isNaN(department)) {
        error.push("This employee department is empty please select any one.");
        document.getElementById("department").focus();
        returnval = false;
    }

    if (lang == "" || !isNaN(lang)) {
        error.push("Please select any language.");
        returnval = false;
    }


    if ((profilepic == "" || !isNaN(profilepic)) && eid == "") {
        error.push("Please select your profile picture.");
        returnval = false;
    } else if (profilepic) {
        if (!/(\.jpg|\.jpeg|\.png|\.gif)$/i.test(profilepic)) {
            error.push("Only jpeg,jpg,png,gif,bmp types files allowed");
            returnval = false;
        }
    }

    if (description == "" || !isNaN(description)) {
        error.push("Please enter some description.");
        document.getElementById("description").focus();
        returnval = false;
    }

    if (joiningdate == "" || !isNaN(joiningdate)) {
        error.push("Please select joining date.");
        document.getElementById("joiningdate").focus();
        returnval = false;
    }

    if (!hobby) {
        error.push("Please select atleast one hobby.");
        returnval = false;
    }

    if (error != '' && returnval == false) {
        let list = "";
        for (let i = 0; i < error.length; i++) {
            list += "<li>" + error[i] + "</li>";
        }
        document.getElementById("formerror").innerHTML = list;
        document.documentElement.scrollTop = 0;
    }
    return returnval;
}
function selected_val() {
    let selected = "";
    let checked = document.querySelectorAll('#department :checked');
    for (let i = 0; i < checked.length; i++) {
        selected = selected + checked[i].value + "\n";
    }
    document.getElementById("hidden_dept").style.display = "block";
    document.getElementById('dept').innerText = selected;
}