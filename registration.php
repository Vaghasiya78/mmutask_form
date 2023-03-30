<?php
ob_start();
include "./includes/db.php";
include "./includes/functions.php";
include "./registration_post.php";
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <title>Responsive Registaration Form</title>
    <link rel="stylesheet" href="./css/form.css">
</head>

<body>
    <div class="container">
        <div class="left-link">
            <a href="./index.php">Go To Dashboard</a>
        </div>
        <h1>Employee Form</h1>
        <!-- multipart/form-data when we use file that time we use this enctype attribute -->
        <form action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="fname">Employee Name<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="name" name="ename" placeholder="Enter your first name" value="<?php echo isset($form_data['ename']) ? $form_data['ename'] : ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="email">Email<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="email" name="email" placeholder="it should contain @,." value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="mobile">Salary<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="salary" name="salary" placeholder="Enter Salary" value="<?php echo isset($form_data['salary']) ? $form_data['salary'] : ''; ?>">
                </div>
            </div>
            <!-- SELECT DEPARTMENT IN OPTION -->
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="department">Department<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <select name="department" id="department">
                        <option value=""> Select Department </option>
                        <option value="HR" <?= (isset($form_data['department']) && $form_data['department'] == 'HR') ? "selected" : ''; ?>>HR</option>
                        <option value="Devloper" <?= (isset($form_data['department']) && $form_data['department'] == 'Devloper') ? "selected" : ''; ?>>Devloper</option>
                        <option value="Designer" <?= (isset($form_data['department']) && $form_data['department'] == 'Designer') ? "selected" : ''; ?>>Designer</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="gender" required>Language<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <input type="radio" id="english" name="lang" value="English" <?= isset($form_data['lang']) && $form_data['lang'] == 'English' ? 'checked' : ''; ?> />
                    <label for="english">English</label>
                    <input type="radio" id="hindi" name="lang" value="Hindi" <?= isset($form_data['lang']) && $form_data['lang'] == 'Hindi' ? 'checked' : ''; ?> />
                    <label for="hindi">Hindi</label>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="profile">Profile Picture<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <?php if (isset($_GET['edit_employee'])) { ?>
                        <img width="50" src="./profile/<?= $form_data['profilepic']; ?>" alt="No Image">
                    <?php } ?>
                    <input type="file" name="uploadfile" accept="image/png, image/gif, image/jpeg" />
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="description">Description<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <textarea name="description" id="description" cols="30" rows="5"><?= isset($form_data['description']) && $form_data['description'] ? $form_data['description'] : ''; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="joiningdate">Date Of Joining<label style="color:red"> *</label>:</label>
                </div>
                <div class="col-90">
                    <input type="Date" id="joiningdate" name="joiningdate" min="1950-01-01" pattern="\d{4}-\d{2}-\d{2}" max="<?php echo date('Y-m-d'); ?>" value="<?php echo isset($form_data['joiningdate']) ? $form_data['joiningdate'] : ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label class="contentlabel" for="hobby">Hobby<label style="color:red"> *</label>:</label>
                </div>

                <!-- DIVIDE HOBBY IN ARRAY FORMATE -->
                <?php isset($form_data['hobby']) ? $form_data['hobby'] = explode(",", $form_data['hobby']) : ''; ?>

                <!-- SELECT HOBBY USING CHECKBOX BUTTON -->
                <div class="col-90">
                    <!-- DISPLAY HOBBY ARRAY -->
                    <?php
                    $array_hobby = array("Coding", "Teaching", "Singing", "Other");
                    foreach ($array_hobby as $hobby_value) { ?>
                        <input type="checkbox" class="hobby" id="<?= $hobby_value ?>" name="hobby[]" value="<?= $hobby_value ?>" <?= isset($form_data['hobby']) && is_array($form_data['hobby']) ? (in_array($hobby_value, $form_data['hobby']) ? 'checked' : '') : ''; ?>>
                        <label for="<?= $hobby_value ?>"><?= $hobby_value ?></label><br />
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <input type="hidden" name="eid" value="<?= isset($_GET['edit_employee']) ? $_GET['edit_employee'] : ''; ?>">
                    <input type='submit' value='Submit' name='submit'>
                </div>
            </div>
        </form>
    </div>
    <div><label style="color:red"> *</label> Field is mendetory</div>
</body>

</html>