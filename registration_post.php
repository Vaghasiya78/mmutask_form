<?php
// ARRAY FOR STORE FORM DATA 
$form_data = array();

//WHEN SUBMIT FORM IT WORK
if (isset($_POST['submit'])) {

    $form_data['ename']      = escape($_POST['ename']);
    $form_data['email']      = escape($_POST['email']);
    $form_data['salary']     = escape($_POST['salary']);
    $form_data['profilepic'] = $_FILES['uploadfile']['name'];
    $form_data['description']    = escape($_POST['description']);
    $form_data['department'] = $_POST['department'];
    if (isset($_POST['hobby'])) {
        $form_data['hobby'] = implode(",", $_POST['hobby']);
    }
    $form_data['lang'] = isset($_POST['lang']) ? $_POST['lang'] : '';
    $form_data['joiningdate']    = ($_POST['joiningdate']);

    //ARRAY FOR ALL FIELDS VALIDATION
    $error = array();
    if ($_POST['ename'] == '') {
        $error[] = '<li>This employee name is empty please insert some data.</li>';
    } elseif (!preg_match("/^([a-zA-Z' ]+)$/", $_POST['ename'])) {
        $error[] = "<li>Only alphabets and whitespace are allowed in employee field.</li>";
    }
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if (!preg_match($pattern, $form_data['email'])) {
        $error[] = "<li>Email is not valid please enter valid email.</li>";
    }
    if ($form_data['email'] == '') {
        $error[] = '<li>This Employee email is empty please insert some data.</li>';
    }
    if ($form_data['salary'] == '') {
        $error[] = '<li>This Employee salary is empty please insert some data.</li>';
    } elseif (!preg_match("/^[0-9]*$/", $form_data['salary'])) {
        $error[] = "<li>Only numeric value is allowed in salary.</li>";
        $form_data['salary'] = null;
    } elseif (strlen($form_data['salary']) >= 7) {
        $error['salary'] = '<li>Please enter only 6 character.</li>';
    }
    if ($form_data['department'] == '') {
        $error[] = '<li>This employee department is empty please select any one.</li>';
    }
    if ($form_data['lang'] == '') {
        $error[] = '<li>Please select any language.</li>';
    }

    //CHECK FOR THIS IS ONLY IMAGE
    $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
    $ext = pathinfo($form_data['profilepic'], PATHINFO_EXTENSION);

    if (isset($_GET['edit_employee'])) {
        if ($form_data['profilepic'] == '') {
            $eid = $_GET['edit_employee'];
            $query = "SELECT profilepic FROM employee WHERE eid = $eid ";
            $select_image = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($select_image)) {
                $form_data['profilepic'] = $row['profilepic'];
            }
        }
    } else {
        if (!in_array($ext, $allowed)) {
            $error[] = "<li>Only jpeg,jpg,png,gif,bmp types files allowed</li>";
        }
        if ($form_data['profilepic'] == '') {
            $error[] = '<li>Please select your profile picture.</li>';
        }
    }

    if ($form_data['description'] == '') {
        $error[] = '<li>Please enter some description.</li>';
    }

    if ($form_data['joiningdate'] == '') {
        $error[] = '<li>Please select joining date.</li>';
    }

    if (!isset($_POST['hobby'])) {
        $error[] = '<li>Please select atleast one hobby.</li>';
    }


    // NO ERROR FOUND RUN THIS QUERY

    if (empty($error)) {

        //IMAGE FILE SET IN FOLDER
        $form_data['profilepic'] = $_FILES["uploadfile"]["name"];
        $tempname   = $_FILES["uploadfile"]["tmp_name"];
        $folder     = "./profile/" . $form_data['profilepic'];
        move_uploaded_file($tempname, $folder);

        //INSERT DATA
        if (isset($_POST['eid']) && $_POST['eid'] == null) {
            $insert_form_data = "INSERT INTO employee (ename,email,salary,department,lang,profilepic,description,joiningdate,hobby) VALUES ('{$form_data['ename']}','{$form_data['email']}','{$form_data['salary']}','{$form_data['department']}','{$form_data['lang']}','{$form_data['profilepic']}','{$form_data['description']}','{$form_data['joiningdate']}','{$form_data['hobby']}')";
            $query = query($insert_form_data);
            if ($query) {
                redirect("index.php?action=register");
            }
        }
        //UPDATE DATA 
        if ((isset($_POST['eid']))) {
            $eid = $_POST['eid'];
            if ($form_data['profilepic'] == '') {
                $eid = $_GET['edit_employee'];
                $query = "SELECT profilepic FROM employee WHERE eid = $eid ";
                $select_image = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_image)) {
                    $form_data['profilepic'] = $row['profilepic'];
                }
                $update_data = "UPDATE employee SET ename='{$form_data['ename']}',email='{$form_data['email']}',salary='{$form_data['salary']}',department='{$form_data['department']}',lang='{$form_data['lang']}',profilepic='{$form_data['profilepic']}',description='{$form_data['description']}',joiningdate='{$form_data['joiningdate']}',hobby='{$form_data['hobby']}' WHERE eid = {$eid}";
            } else {
                $update_data = "UPDATE employee SET ename='{$form_data['ename']}',email='{$form_data['email']}',salary='{$form_data['salary']}',department='{$form_data['department']}',lang='{$form_data['lang']}',profilepic='{$form_data['profilepic']}',description='{$form_data['description']}',joiningdate='{$form_data['joiningdate']}',hobby='{$form_data['hobby']}' WHERE eid = {$eid}";
            }
            $query = query($update_data);
            if ($query) {
                redirect("index.php?action=edited");
            }
        }
        // WHEN ERROR OCCUR GO HERE
    } else {
        foreach ($error as $key => $value) {
            echo isset($error[$key]) ? $error[$key] : '';
        }
    }
    // SHOW EDIT DATA IN FORM
} else if (isset($_GET['edit_employee'])) {
    $eid = $_GET['edit_employee'];
    $selec_query = "SELECT * FROM employee WHERE eid = '$eid'";
    $query = query($selec_query);
    $form_data = mysqli_fetch_array($query);
}
