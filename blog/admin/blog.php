<?php

include("check.php");
if($input->get('do')=='delete'){
	$pid=$input->get('pid');

	$sql="delete from  page  where  pid='{$pid}'";
	$is=$db->query($sql);
	if($is){
		header("location:blog.php");
	}else{
		echo '删除失败';
	}
}

//定义每页显示数量

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

$sql = "select *  from  page limit $offset,{$pageNum}";
$result = $db->query( $sql );
//
$rows=array();
while($row=$result->fetch_array( MYSQL_ASSOC ) ){
$rows[]=$row;
}

?>


<!DOCTYPE html>
<html>
<head>
<title>博客管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include(PAT . "/healder.php");
?>
</head>
<body>
<?php include('nav.inc.php');?>

	<div class="container">
	<h1>博客管理 <small class='pull-right'><a class='btn btn-default' href="blog_add.php">添加博客</a></small></h1>
	<hr/>
		<div class="rows">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>标题</th>
						<th>作者</th>
						<th>插入时间</th>
						<th>修改时间</th>
						<th>管理</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($rows as $row) :?>
					<tr>
						<td><?php echo $row['pid']; ?></td>
						<td><?php echo $row['title'];?></td>
						<td><?php echo $row['author'];?></td>
						<td><?php echo date("Y-m-d H:i:s",$row['intime']);?></td>
						<td><?php echo date("Y-m-d H:i:s",$row['uptime']);?></td>
						<td>
							<a href="blog_add.php?pid=<?php echo $row['pid'];?>">修改</a>
							<a href="blog.php?do=delete&pid=<?php echo $row['pid'];?>">删除</a>	
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
		    </table>
			<nav class="col-md-offset-3">
				  <ul class="pagination  ">
					<?php
					if($maxpage > 10){
$maxPageCount=11; 
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
        $htmlstr.="<li> <a href='blog.php?page=". 1 ."' >首页</a> </li>";
        $htmlstr.="<li> <a href='blog.php?page=". ($page-1) ."' >上一页</a> </li>";
    }
    for ($i=$startPage;$i<=$endPage; $i++){
         
        $htmlstr.="<li><a href='blog.php?page=".$i."'>".$i."</a></li>";
    }
     
    if ($page<$maxpage){
        $htmlstr.="<li><a href='blog.php?page=".($page+1) . "' >下一页</a> </li>";
        $htmlstr.="<li><a href='blog.php?page=".$maxpage . "' >尾页</a> </li>";
 
    }

echo   $htmlstr;
}else{

					   $prev=$page-1;
					    $next = $page +1;
						$hrefTpl = '<li><a href="blog.php?page=%d">%s</a></li>';
						

   //输出数据

if($page >=1){
echo sprintf( $hrefTpl, 1, '首页');
echo sprintf( $hrefTpl,$prev,'上一页');

}
for($i=1;$i<=$maxpage;$i++){
							echo  sprintf( $hrefTpl, $i, "{$i}");
						}

if($page<=$maxpage){
	echo sprintf($hrefTpl,$next,'下一页');
	echo sprintf($hrefTpl,$maxpage,'最后一页');
}
}
 ?>

						

						
 
 	 
				  </ul>
			</nav>
		</div>
			
	</div>
</body>

</html>