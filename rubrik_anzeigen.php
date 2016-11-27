<?php
function rubrik($DBLink)
{

    $sql = "SELECT id, name FROM category";
    $result = mysqli_query($DBLink, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
    }
}