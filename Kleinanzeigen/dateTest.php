<?php

$dateGrund = date('Y-m-d h:m:s');
echo $dateGrund;
echo "<br>";
$time = 90;
$date = date('Y-m-d h:m:s', strtotime('+' . $time . ' days'));
echo $date;

echo "<br>";

$date1 = date_create($dateGrund);
$date2 = date_create($date);
$diff  = date_diff($date1,$date2);
echo $diff->format("%R%a");


// SQL
// SELECT annoncen.date, NOW() FROM annoncen
// SELECT annoncen.date, NOW() AS Heute, DAY(NOW()) - DAY(annoncen.date) AS Tage FROM annoncen
// SELECT annoncen.date, NOW() AS Heute, DAY(NOW()) - DAY(annoncen.date) AS Tage, @tage := DAY(NOW()) - DAY(annoncen.date) AS Diffdays, @kosten := annoncen.priceFromSeller * annoncen.price AS Kosten, @tage * @kosten AS ENDPREIS FROM annoncen
// SELECT annoncenID, @tage := DAY(NOW()) - DAY(annoncen.date)+5, @kosten := priceFromSeller * price, @endpricevar := @tage * @kosten FROM annoncen; UPDATE annoncen SET endprice=@endpricevar WHERE annoncenID='49';


//Andere Lösung
include("dbMaster.php");

$sql = "SELECT annoncenID, rubrik.rubrik, titel, text, priceFromSeller, date, timeToDeath, price, days, visitors, display FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID";
    $result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result)) 
    {
        $date = $row["date"];
        $days = $row["days"];
        $priceFromSeller = $row['priceFromSeller'];
        $price = $row["price"];
        $ausgabe = date_diff($dateGrund, $date);
        
        $date1 = date_create($dateGrund);
        $date2 = date_create($date);
        $diff  = date_diff($date1,$date2);
        echo $diff->format("%R%a");
        
        echo $dateGrund . " - " . $date . "<br>";
        echo $ausgabe->format("%R%a") . "<br>";
        echo $days . "<br>";
        echo $priceFromSeller . "<br>";
        echo $price . "<br>";

        //$sqlAnswer = "SELECT @tage := DAY(NOW()) - DAY(annoncen.date)+5, @kosten := priceFromSeller * price, @endpricevar := @tage * @kosten FROM annoncen;"
        //        . "UPDATE annoncen SET endprice=@endpricevar WHERE annoncenID='$annoncenID';";
        //mysqli_query($conn, $sqlAnswer);
    }
