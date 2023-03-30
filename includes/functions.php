<?php
// ESCAPE DATA VALUE METHOD
function escape($data)
{
    global $connection;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($connection, $data);
}
//CONFIRM RESULT QUERY METHOD
function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}
//SUBMIT QUERY METHOD
function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

// REDIRECT PAGE METHOD
function redirect($location)
{
    header("Location: ./" . $location);
    exit;
}

