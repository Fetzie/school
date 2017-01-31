<html>
<head>
<meta charset="UTF-8">

</head>
<body>
<form action="./kosten.php" enctype="application/x-www-form-urlencoded">

<p>Fl&auml;che je Stockwerk in qm: <input type="text" name="flaecheJeStockWerk"></p>
<p>Stockwerkhoehe in m: <input type="text" name="stockwerkHoehe"></p>
<p>Anzahl Stockwerke: <input type="text" name="anzahlStockwerke"></p>
<p>Baujahr des Sanierungsobjektes /letzte Sanierung</p>
  <input type="radio" name="alter" value="vor_1950" checked> Vor 1950<br>
  <input type="radio" name="alter" value="vor_1977"> Vor 1977<br>
  <input type="radio" name="alter" value="vor_1987"> Vor 1987<br>
  <input type="radio" name="alter" value="vor_1998"> Vor 1998<br>
  <input type="radio" name="alter" value="vor_2002"> Vor 2002<br>
  <input type="radio" name="alter" value="vor_2009"> Vor 2009<br>
<input type="submit" value="Absenden">
<input type="reset" value="Zuruecksetzen"> 
  
</form>

</body>
</html>