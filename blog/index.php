<?php

include("config.php");

/*$sql = "select * from page order by pid desc limit 0,10";
$result = $db->query( $sql );
$blogs=array();
while( $row = $result->fetch_array( MYSQL_ASSOC ) ){
	$blogs[] = $row;
}
*/

$pageNum = $seting['pagenum'];

//计算数据总量
$sql = "select count(*) AS total from page";
$total =$db->query($sql)->fetch_array( MYSQL_ASSOC )['total'];
$maxpage = ceil($total / $pageNum);


//获取并处理当前页码
$page = (int)$input->get( 'page' );
$page = $page < 1 ? 1: $page;

//计算偏移量
$offset = ($page - 1) * "{$pageNum}";

$sql = "select *  from  page order by pid desc limit $offset,{$pageNum}";
$result = $db->query( $sql );
//
$rows=array();
while($row = $result->fetch_array( MYSQL_ASSOC ) ){
$rows[] = $row;
}

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
		<?php foreach( $rows as $blog):?>
		<div class="panel panel-default">
			<div class="panel-heading">
			<a  href="read.php?pid=<?php echo $blog['pid'];?>";> <?php echo $blog['title'];?></a>
			</div>
			<div class="panel-body">
			<?php echo mb_substr(strip_tags($blog['content']),0,50 );?>
			</div>
		</div>
		<?php endforeach; ?>		
		</div>
		<nav class="col-md-offset-3">
			<ul class="pagination  ">
			<?php
			$maxPageCount=10; 
			$buffCount=5;
			$startPage=1;

			if  ($page< $buffCount){
			$startPage=1;
			}else if($page>=$buffCount  and $page<$maxpage-$maxPageCount  ){
			$startPage=$page-$buffCount+1;
			}else{
			$startPage=$maxpage-$maxPageCount+1;
			}

			$endPage=$startPage+$maxPageCount-1;


			$htmlstr="";

			$line=1;
			while ($row=$result->fetch_array( MYSQL_ASSOC )){
			//$htmlstr.=$line."行";
			$htmlstr.=$row['id'];

			$line++;
			} 

			if ($page > 1){
			$htmlstr.="<li> <a href='index.php?page=". 1 ."' >首页</a> </li>";
			$htmlstr.="<li> <a href='index.php?page=". ($page-1) ."' >上一页</a> </li>";
			}

			for ($i=$startPage;$i<=$maxpage; $i++){
			$htmlstr.="<li><a href='index.php?page=".$i."'>".$i."</a></li>";
			}

			if ($page<$maxpage){
			$htmlstr.="<li><a href='index.php?page=".($page+1) . "' >下一页</a> </li>";
			$htmlstr.="<li><a href='index.php?page=".$maxpage . "' >尾页</a> </li>";

			}
			echo   $htmlstr;
			
			echo   "<li><a>共{$maxpage}页</a></li>";

/* $prev=$page-1;
$next = $page +1;
$hrefTpl = '<li><a href="blog.php?page=%d">%s</a></li>';


//输出数据

if($page >=1){
echo sprintf( $hrefTpl, 1, '首页');
echo sprintf( $hrefTpl,$prev,'上一页');

}
for($i=1;$i<=$maxpage;$i++){
echo  sprintf( $hrefTpl, $i, "第{$i}页");
}

if($page<=$maxpage){
echo sprintf($hrefTpl,$next,'下一页');
echo sprintf($hrefTpl,$maxpage,'最后一页');
}*/
		 	?>						 
			</ul>
		</nav>
	</div>
</body>

</html>

