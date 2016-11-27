<?php

function priceCalc($days, $priceFromSeller)
{
    $procent = 0.000125;
    if($days == 30)
    {
        $price = $procent * $days / 20;
        $timeToDeath = date('Y-m-d h:m:s', strtotime('+' . $days . 'days'));
        $priceCalc = array($price, $timeToDeath);
        return $priceCalc;
        exit;
    }
    elseif($days == 60)
    {
        $price = $procent * $days / 30;
        $timeToDeath = date('Y-m-d h:m:s', strtotime('+' . $days . 'days'));
        $priceCalc = array($price, $timeToDeath);
        return $priceCalc;
        exit;
    }
    elseif($days == 90)
    {
        $price = $procent * $days / 40;
        $timeToDeath = date('Y-m-d h:m:s', strtotime('+' . $days . 'days'));
        $priceCalc = array($price, $timeToDeath);
        return $priceCalc;
        exit;
    }
}