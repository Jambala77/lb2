<?php
$teacherToShow=$_POST['teacherToShow'];
$discipleToShow=$_POST['discipleToShow'];
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
	if (!empty($_POST['teacherToShow'])){
		//echo $groupToShow;
		if ((stristr($item['teacher'],$teacherToShow)!=false)&&($discipleToShow==$item['disciple'])){
			$table=$table."<tr><td>".$item['date']."</td><td>".$item['number']."</td><td>".$item['auditorium']."</td><td>".$item['disciple']."</td><td>".$item['type']."</td><td>".$item['group']."</td><td>".$item['teacher']."</td></tr>";
			
		}
	}
	//
	$tempTeacher=explode(",",$item['teacher']);
	foreach($tempTeacher as &$element){
		//echo $element."<br>";
		if (!strripos($teacher,$element)){
			$teacher=$teacher."<option>".$element."</option>";
		}
		
	}
	if (!strripos($disciple,$item['disciple'])){
		$disciple=$disciple."<option>".$item['disciple']."</option>";
	}
	
}
		//echo $table;
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 2(Teacher and disciple)</title>
  <link href="external.css" rel="stylesheet">
 </head>
 <body>

<div class="navigation">
<form action="teacher_disciple.php" method="post">
<a style="margin-left: 50px;">Выберите teacher and disciple:</a><br>
<span class="custom-dropdown big">
    <select name="teacherToShow">    
        <option selected="selected"  disabled>Teacher</option>
		<?php echo $teacher; ?>
    </select>
</span>
<span class="custom-dropdown big">
    <select name="discipleToShow">    
        <option selected="selected"  disabled>Disciple</option>
		<?php echo $disciple; ?>
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
