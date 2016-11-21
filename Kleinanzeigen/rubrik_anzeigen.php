<?php
function rubrik()
{
    include ("dbMaster.php");

    $sql = "SELECT rubrikID, rubrik FROM rubrik";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        echo "<option value='" . $row["rubrikID"] . "'>" . $row["rubrik"] . "</option>";
    }
}