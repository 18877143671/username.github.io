<?php
include("config.php");
$pid = (int)$input->get( 'pid' );

if($pid<1){
	die('无效文章');
	}
$sql = "select * from page where pid='{$pid}'";
$blog = $db->query( $sql )->fetch_array( MYSQL_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $seting['title'];?></title>
<meta charset="utf-8">
<?php include(PAT . "/healder.php");?>
</head>
<body>
	<div class="container">
		<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><?php ;?></div>
			<div class="panel-body">
			Panel content
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Panel heading without title</div>
			<div class="panel-body">
			Panel content
			</div>
		</div>		
		</div>
		<div class="col-md-9">

		<div class="panel panel-default">
			<div class="panel-heading">
			<?php echo $blog['title'];?></a>
			</div>
			<div class="panel-body">
			<?php echo $blog['content'];?>
			</div>
		</div>
		
		</div>
	</div>
</body>

</html>
