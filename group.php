<?php
$groupToShow=$_POST['groupToShow'];
$groupToShow=trim($groupToShow);
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
foreach ($cursor as $item) {
	if (!empty($_POST['groupToShow'])){
		//echo $groupToShow;
		if (stristr($item['group'],$groupToShow)!=false){
			$table=$table."<tr><td>".$item['date']."</td><td>".$item['number']."</td><td>".$item['auditorium']."</td><td>".$item['disciple']."</td><td>".$item['type']."</td><td>".$item['group']."</td><td>".$item['teacher']."</td></tr>";
			
		}
	}
	//
	$tempGroup=explode(",",$item['group']);
	foreach($tempGroup as &$element){
		//echo $element."<br>";
		if (!strripos($group,$element)){
			$group=$group."<option>".$element."</option>";
		}
		
	}
	
}
		//echo $table;
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 2</title>
  <link href="external.css" rel="stylesheet">
 </head>
 <body>

<div class="navigation">
<form action="group.php" method="post">
<a style="margin-left: 50px;">Выберите группу:</a><br>
<span class="custom-dropdown big">
    <select name="groupToShow">    
        <option selected="selected"  disabled>Group</option>
		<?php echo $group; ?>
    </select>
</span>
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
