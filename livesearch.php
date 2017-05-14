<?php
$dbc = mysqli_connect('localhost', 'root', '', 'abc') or die('Error connecting to server');
$xmlDoc=new DOMDocument();
//$xmlDoc->load("links.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $query1="SELECT * FROM abc WHERE emplid=$q";
  $result=mysqli_query($dbc, $query1) or die('Please recheck Employee ID');
  echo '<html>';
  echo '<body>';
  echo '<head>';
  echo '<link type="text/css" href="main.css" rel="stylesheet">';
  echo '<meta charset="UTF-8" lang="en" name="viewport" content="width=device-width, initial-scale=1.0">';
  echo '</head>';
echo '<div align="center" class="searchwidth">';
echo '<table style="border:1px solid black;border-collapse:collapse;">';
$first_row = true;
while ($row = mysqli_fetch_assoc($result)) {
    
    if ($first_row) {
        foreach($row as $key => $field) {
            echo ("&nbsp");
            echo '<th class="tablayouts">' . htmlspecialchars($key) . '</th>';
            echo ("&nbsp");
            $first_row=false;
        }
        echo '</tr>';
    }
    echo '<tr>';
    foreach($row as $key => $field) {
        echo ("&nbsp");
        echo '<td class="tdlayouts">' . htmlspecialchars($field) . '</td>';
        echo ("&nbsp");
    }
    echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '</body>';
echo '</html>';
}

?>