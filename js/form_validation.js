function form_validation() {

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
    if (ename == "") {
        error.push("This employee name is empty please insert some data.");
        returnval = false;
    } else if (!/^[A-Za-z\s]+$/.test(ename)) {
        error.push("Only alphabets and whitespace are allowed in employee field.");
        returnval = false;
    }

    if (email == "") {
        error.push("This employee email is empty please insert some data.");
        returnval = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g.test(email)) {
        error.push("Email is not valid please enter valid email.");
        returnval = false;
    }

    if (salary == "") {
        error.push("This employee salary is empty please insert some data.");
        returnval = false;
    } else if (!/^[0-9]+$/.test(salary)) {
        error.push("Only numeric value is allowed in salary.");
        returnval = false;
    } else if ((salary.length) >= 7) {
        error.push("Enter Salary value is less then 6 character.");
        returnval = false;
    }

    if (department == "" || department == null) {
        error.push("This employee department is empty please select any one.");
        returnval = false;
    }

    if (lang == "" || lang == null) {
        error.push("Please select any language.");
        returnval = false;
    }


    if ((profilepic == "" || profilepic == null) && eid == "") {
        error.push("Please select your profile picture.");
        returnval = false;
    } else if (profilepic) {
        if (!/(\.jpg|\.jpeg|\.png|\.gif)$/i.test(profilepic)) {
            error.push("Only jpeg,jpg,png,gif,bmp types files allowed");
            returnval = false;
        }
    }

    if (description == "" || description == null) {
        error.push("Please enter some description.");
        returnval = false;
    }

    if (joiningdate == "" || joiningdate == null) {
        error.push("Please select joining date.");
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