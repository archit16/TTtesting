<html>
<head>
  <link type="text/css" href="main.css" rel="stylesheet">
  <meta charset="UTF-8" lang="en" name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script>
  function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
  </script>

</head>
<body style="font-size:20px;"> 

<div class="container topBotomBordersOut">
<ul class="nav1">
  <li class="nav2"><a class="active" href="index.php" style="font-family:'Questrial',sans-serif;">Employee</a></li>
  <li class="nav2"><a href="#" style="font-family:'Questrial',sans-serif;">----</a></li>
  <li class="nav2"><a href="#" style="font-family:'Questrial',sans-serif;">----</a></li>
  <li class="nav2"><a href="#" style="font-family:'Questrial',sans-serif;">----</a></li>
  <li class="nav2"><a href="#" style="font-family:'Questrial',sans-serif;">----</a></li>
</ul>
</div>
<br>
<br>
<br>
<i class="fa fa-search fa-3x" style="position:absolute;margin-top:25px;margin-left:70px;" aria-hidden="true"></i>
<form style="border-radius:0px;border:0px;">
<input type="text" name="su" id="su" class="fields" style="margin-left:150px;" onkeyup="showResult(this.value)" placeholder="Enter Employee ID">
<div id="livesearch"></div>
</form>
<!--<input type="submit" name="submit" class="button">-->
<div>
<div id="target-content" >loading...</div>
 <?php
$dbc = mysqli_connect('localhost', 'root', '', 'abc') or die('Error connecting to server');
$query = "SELECT * FROM abc;";
$result=mysqli_query($dbc, $query) or die('Error querying database');
$query1="SELECT COUNT(emplid) FROM abc";
$result1=mysqli_query($dbc, $query1) or die('Error Creating pagination');
$row = mysqli_fetch_row($result1);  
$total_records = $row[0];  
$limit = 15;
$total_pages = ceil($total_records / $limit);
echo'<div align="center" id="indexwala">
<ul class="pagination" id="pagination">';
if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
            if($i == 1):
echo'<li class="pagination active"  id='.$i.'><a href="pagination.php?page='.$i.'">'.$i.'</a></li> ';
else:
echo '<li class="pagination" id="'.$i.'"><a href="pagination.php?page='.$i.'">'.$i.'</a></li>';
endif;          
endfor;
endif;?>  

</body>
<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("pagination.php?page=1");
    jQuery("#pagination li").live('click',function(e){
    e.preventDefault();
        jQuery("#target-content").html('loading...');
        jQuery("#pagination li").removeClass('active');
        jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("pagination.php?page=" + pageNum);
    });
    });
</script>
</html>