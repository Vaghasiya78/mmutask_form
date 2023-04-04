<?php

//WHEN SUBMIT FORM IT WORK
if (isset($_POST['submit'])) {

    //IMAGE FILE SET IN FOLDER
    $profilepic = $_FILES["uploadfile"]["name"];
    $tempname   = $_FILES["uploadfile"]["tmp_name"];
    $folder     = "./profile/" . $form_data['profilepic'];
    move_uploaded_file($tempname, $folder);

    if (isset($_POST['hobby'])) {
        $_POST['hobby'] = implode(",", $_POST['hobby']);
    }

    //INSERT DATA
    if (isset($_POST['eid']) && $_POST['eid'] == null) {
        $insert_form_data = "INSERT INTO employee (ename,email,salary,department,lang,profilepic,description,joiningdate,hobby) VALUES ('{$_POST['ename']}','{$_POST['email']}','{$_POST['salary']}','{$_POST['department']}','{$_POST['lang']}','{$profilepic}','{$_POST['description']}','{$_POST['joiningdate']}','{$_POST['hobby']}')";
        $query = query($insert_form_data);
        if ($query) {
            redirect("index.php?action=register");
        }
    }
    //UPDATE DATA 
    if ((isset($_POST['eid']))) {
        $eid = $_POST['eid'];
        if ($form_data['profilepic'] == '') {
            $eid = $_GET['eid'];
            $query = "SELECT profilepic FROM employee WHERE eid = $eid ";
            $select_image = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($select_image)) {
                $form_data['profilepic'] = $row['profilepic'];
            }
            $update_data = "UPDATE employee SET ename='{$_POST['ename']}',email='{$_POST['email']}',salary='{$_POST['salary']}',department='{$_POST['department']}',lang='{$_POST['lang']}',profilepic='{$form_data['profilepic']}',description='{$_POST['description']}',joiningdate='{$_POST['joiningdate']}',hobby='{$_POST['hobby']}' WHERE eid = {$eid}";
        } else {
            $update_data = "UPDATE employee SET ename='{$_POST['ename']}',email='{$_POST['email']}',salary='{$_POST['salary']}',department='{$_POST['department']}',lang='{$_POST['lang']}',profilepic='{$form_data['profilepic']}',description='{$_POST['description']}',joiningdate='{$_POST['joiningdate']}',hobby='{$_POST['hobby']}' WHERE eid = {$eid}";
        }
        $query = query($update_data);
        if ($query) {
            redirect("index.php?action=edited");
        }
    }
    // SHOW EDIT DATA IN FORM
} else if (isset($_GET['action'])) {
    $eid = $_GET['eid'];
    $selec_query = "SELECT * FROM employee WHERE eid = '$eid'";
    $query = query($selec_query);
    $form_data = mysqli_fetch_array($query);
}
