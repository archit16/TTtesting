<?php
$dbc = mysqli_connect('localhost', 'root', '', 'abc') or die('Error connecting to server');
$limit = 15;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM abc ORDER BY emplid ASC LIMIT $start_from, $limit";  
$result = mysqli_query($dbc,$sql);  
echo '<div align="center" style="font-size:20px;">';
echo '<table style="border:0.5px solid black;border-collapse:collapse;">';
$first_row = true;
while ($row = mysqli_fetch_assoc($result)) {
    
    if ($first_row) {
        foreach($row as $key => $field) {
            echo ("&nbsp");
            echo '<th class="tablayout"><b>' . htmlspecialchars($key) . '</b></th>';
            echo ("&nbsp");
            $first_row=false;
        }
        echo '</tr>';
    }
    echo '<tr>';
    foreach($row as $key => $field) {
        echo ("&nbsp");
        echo '<td class="tdlayout">' . htmlspecialchars($field) . '</td>';
        echo ("&nbsp");
    }
    echo '</tr>';
}
echo '</table>';
echo '</div>';
?>