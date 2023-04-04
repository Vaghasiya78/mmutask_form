 <?php
    ob_start();
    include "./includes/db.php";
    include "./includes/functions.php";

    // REGISTER SUCCESSFULLY POP-UP MENU.
    if (isset($_GET['action']) && $_GET['action'] == 'register') {
        echo '<script>alert("Successfully Registerd New Data");
               window.location = "./index.php";
               </script>';
    }

    // EDIT SUCCESSFULLY POP-UP MENU.
    if (isset($_GET['action']) && $_GET['action'] == 'edited') {
        echo '<script>alert("Successfully Edited data");
              window.location = "./index.php";
              </script>';
    }

    // ARRAY OF COLUMN NAME AND SELECT COLUMN WHICH IS SELECTED OR SORTING ORDER.
    $array_column_name = array('eid', 'ename', 'email', 'salary', 'department', 'lang', 'joiningdate');
    $select_column = isset($_GET['column']) && in_array($_GET['column'], $array_column_name) ? $_GET['column'] : $array_column_name[0];
    $sort_order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

    //SET PAGINATION FOR SHOW DIFFRENT PAGE DATA.
    $per_page = 3;
    $page = 0;
    $current_page = 1;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page <= 0) {
            $page = 0;
            $current_page = 1;
        } else {
            $current_page = $page;
            $page--;
            $page = $page * $per_page;
        }
    }

    //SELECT QUERY FOR PARTICULAR DATA.
    $select_query = "SELECT * FROM employee ";
    // if (isset($_GET['search_data']) && isset($_GET['column'])) {
    //     $search = $_GET['search_data'];
    //     $select_query .= "WHERE eid like '%$search%' or ename like '%$search%' or salary like '%$search%' or email like '%$search%' or department like '%$search%' or hobby like '%$search%' or lang like '%$search%' ";
    //     $select_query .= "ORDER BY $select_column $sort_order ";
    // } else
    if (isset($_GET['search_data'])) {
        $search = $_GET['search_data'];
        $select_query .= "WHERE eid like '%$search%' or ename like '%$search%' or salary like '%$search%' or email like '%$search%' or department like '%$search%' or hobby like '%$search%' or lang like '%$search%' ";
    }
    $select_query .= "ORDER BY $select_column $sort_order ";
    //  else {
    //     $select_query .= "ORDER BY eid DESC ";
    // }
    $query = query($select_query);
    $record = mysqli_num_rows($query);
    ?>

 <!-- HTML CODE FOR DISPLAY DATA -->
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width,
				initial-scale=1.0">
     <title>DASHBOARD</title>
     <link rel="stylesheet" href="./css/main.css">
     <script src="https://kit.fontawesome.com/ed24345c86.js" crossorigin="anonymous"></script>

     <!-- DELETE JAVASCRIPT QUERY -->
     <script language="JavaScript" type="text/javascript">
     function delete_user(eid) {
         if (confirm('Are You Sure to Delete this Record?')) {
             window.location.href = 'index.php?delete=' + eid;
         }
     }
     </script>
 </head>

 <body>
     <!--FOR HEADER PART-->
     <header>

         <div class="logosec">
             <div class="logo"><a href="index.php">Dashboard</a></div>
             <img src="./images/lining.png" class="icn menuicn" id="menuicn" alt="menu-icon">
         </div>
         <form action="" method="get">
             <!-- SEARCH BAR FOR GIVE DIFFRENT TYPES OF VALUE -->
             <div class="searchbar">
                 <input type="text" placeholder="Search" name="search_data"
                     value="<?= isset($_GET['search_data']) ? $_GET['search_data'] : ''; ?>">
                 <input type="hidden" name="column" value="<?= isset($_GET['column']) ? $_GET['column'] : 'eid'; ?>">
                 <input type="hidden" name="order" value="<?= isset($_GET['order']) ? $_GET['order'] : 'desc'; ?>">
                 <input type="hidden" name="page" value="<?= isset($_GET['page']) ? $_GET['page']  = 1 : ''; ?>">
                 <button class="icon" type="submit"><span class="fa-solid fa-magnifying-glass"></span></button>
             </div>
         </form>

     </header>
     <!-- MAIN CONTAINER -->
     <div class="main-container">
         <div class="navcontainer">
             <nav class="nav">
                 <div class="nav-upper-options">
                     <div class="nav-option option1">
                         <img src="./images/dashboard.png" class="nav-img" alt="dashboard">
                         <h3><a href="./index.php" class="img-registration">Employees_Detail</a></h3>
                     </div>
                 </div>
             </nav>
         </div>
         <div class="main">

             <div class="report-container">
                 <!-- HEADER REPORT CONTAINER -->
                 <div class="report-header">
                     <h1 class="recent-Articles">Employee Details</h1>
                     <label class="view"><a href="registration.php">Add Data</a></label>
                 </div>
                 <?php
                    if ($record < 1) {
                        echo "<h1 class='text-center'>No Data Available</h1>";
                    } else {
                    ?>
                 <div class="table-content">

                     <form action="" method="get">
                         <table>
                             <thead>
                                 <tr>
                                     <?php
                                            //SORTING DATA FUNCTION
                                            function sort_data($column_name, $sort_order)
                                            {
                                                echo "index.php?column=" . $column_name . "&order=" . (isset($asc_or_desc) ? ($asc_or_desc = $sort_order == 'asc' ? 'desc' : 'asc') : ($asc_or_desc = $sort_order == 'desc' ? 'asc' : 'desc')) . "&search_data=" . (isset($_GET['search_data']) ? $_GET['search_data'] : '') . "&page=" . (isset($_GET['page']) ? $_GET['page'] = 1 : '');
                                            }
                                            ?>

                                     <th>Profile</th>
                                     <!-- Assending and Descending value with sorting and searching function -->
                                     <th><a href="<?= sort_data('eid', $sort_order) ?>">Emp_Id</a></th>
                                     <th><a href="<?= sort_data('ename', $sort_order) ?>">Emp_Name</a></th>
                                     <th><a href="<?= sort_data('email', $sort_order) ?>">Email</a></th>
                                     <th><a href="<?= sort_data('salary', $sort_order) ?>">Salary</a></th>
                                     <th><a href="<?= sort_data('department', $sort_order) ?>">Department</a></th>
                                     <th><a href="<?= sort_data('lang', $sort_order) ?>">Language</a></th>
                                     <th><a href="<?= sort_data('joiningdate', $sort_order) ?>">Joining Date</a></th>
                                     <th>Hobby</th>
                                     <th>Edit</th>
                                     <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                        // SELECT PAGE VALUES
                                        $pagi = ceil($record / $per_page);  //make proper integer number using ceil
                                        $select_query .= "LIMIT $page, $per_page";
                                        $query = query($select_query);

                                        //DISPLAY SELECTED RECORD HERE
                                        if ($query && (mysqli_num_rows($query) > 0)) {
                                            while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                 <tr>
                                     <td><img class='image' src='./profile/<?= $row['profilepic'] ?>' alt='Image'></td>
                                     <td><?= $row['eid'] ?></td>
                                     <td><?= $row['ename'] ?></td>
                                     <td><?= $row['email'] ?></td>
                                     <td><?= $row['salary'] ?></td>
                                     <td><?= $row['department'] ?></td>
                                     <td><?= $row['lang'] ?></td>
                                     <td><?= date("d-M-Y", strtotime($row['joiningdate'])) ?></td>
                                     <td><?= $row['hobby'] ?></td>
                                     <td><a
                                             href='./registration.php?action=edit_employee&eid=<?= $row['eid'] ?>'>Edit</a>
                                     </td>
                                     <td><a href='javascript: delete_user(<?= $row['eid'] ?>)'>Delete</a></td>
                                 </tr>
                                 <?php } ?>
                             </tbody>
                             <?php
                                        } else {
                                            header("Location: index.php?column=" . (isset($_GET['column']) ? $_GET['column'] : 'eid') . "&order=" . (isset($_GET['order']) ? $_GET['order'] : 'desc') . "&search_data=" . (isset($_GET['search_data']) ? $_GET['search_data'] : '') . "&page=1");
                                        }

                                ?>
                         </table>
                 </div>

                 <!-- PAGE NUMBERS LINK -->
                 <div class="pagging">
                     <ul class="pager">
                         <?php
                                for ($i = 1; $i <= $pagi; $i++) {

                                    if ($current_page == $i) {
                                        echo " <li><a class='active_link' href='javascript:void(0)'>{$i}</a></li>";
                                    } else {
                                ?>
                         <li>
                             <a
                                 href="index.php?column=<?= isset($_GET['column']) ? $_GET['column'] : 'eid'; ?>&order=<?= isset($_GET['order']) ? $_GET['order'] : 'desc'; ?>&search_data=<?= isset($_GET['search_data']) ? $_GET['search_data'] : ''; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                         </li>
                         <?php
                                    }
                                }
                                ?>
                     </ul>
                 </div>
                 <?php } ?>
             </div>
         </div>
     </div>

     </form>
     <!-- DELETE FUNCTION FOR PARTICULAR DATA -->
     <?php
        if (isset($_GET['delete'])) {
            $eid = $_GET['delete'];
            $delete_query = "DELETE FROM employee WHERE eid = '$eid'";
            $query = query($delete_query);
            if ($query) {
                echo "<script>window.location.href = 'index.php';</script>";
            }
        }
        ?>
     <script src="./js/index.js"></script>
 </body>

 </html>