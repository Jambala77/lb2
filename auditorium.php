<?php
$auditoriumToShow=$_POST['auditoriumToShow'];
require_once __DIR__ . '/vendor/autoload.php';
$m = new MongoClient();
$db = $m->selectDB("dbforlab");
$rent =$db->schedule;
$collections = $db->listCollections();

$cursor = $rent->find(
    [
    ]
);
//echo $timeToShow;
if (!empty($_POST['auditoriumToShow'])){
	
}
foreach ($cursor as $item) {
	if (!empty($_POST['auditoriumToShow'])){

		//echo $groupToShow;
		if ($auditoriumToShow==$item['auditorium']){
			$table=$table."<tr><td>".$item['date']."</td><td>".$item['number']."</td><td>".$item['auditorium']."</td><td>".$item['disciple']."</td><td>".$item['type']."</td><td>".$item['group']."</td><td>".$item['teacher']."</td></tr>";
			
		}
	}
	//
	if (!strripos($auditorium,$item['auditorium'])){
		$auditorium=$auditorium."<option>".$item['auditorium']."</option>";
	}
	
}
		//echo $table;
?>
<!DOCTYPE HTML>
<html>
 <head>
  <script>


function addData(str) {
	
	if (localStorage.TempSave==null){
		localStorage.setItem("TempSave", str);
	}else{
		localStorage.setItem("TempSave", localStorage.TempSave+","+str);
	}
	
	
}
 </script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 2</title>
  <link href="external.css" rel="stylesheet">
 </head>

 <body>

<div class="navigation">
<form action="auditorium.php" method="post">
<a style="margin-left: 50px;">Выберите группу:</a><br>
<span class="custom-dropdown big">
    <select name="auditoriumToShow"onchange="addData(this.value)" >    
        <option selected="selected"  disabled>Auditorium</option>
		<?php echo $auditorium; ?>
    </select>
</span>
<span class="custom-dropdown big">
    <select id="mySelect" name="auditoriumToShow" >    
        <option  selected="selected" disabled>Saved</option>
    </select>
</span>
<script>
  if (localStorage.getItem('TempSave')!=null){
	
	//alert(localStorage.getItem('TempSave'));
	var arrayOfStrings = localStorage.getItem('TempSave').split(",");
	//alert(arrayOfStrings);
	arrayOfStrings.forEach(addDataOption);

  }

function addDataOption(item) {
	//alert(item);
var x = document.getElementById("mySelect");
var option = document.createElement("option");
option.text = item;
x.add(option);
}
</script>
<input class="btn third" type="submit" value="Загрузить" />
</form>
<table id="myTable" class="table_dark">
   <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Auditorium</th>
	<th>Disciple</th>
	<th>Type</th>
	<th>Group</th>
	<th>Teacher</th>
   </tr>
   <?php echo $table; ?>
</table><br>

</div>

 </body>
</html>
