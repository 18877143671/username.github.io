<?php
include('check.php');


$key = 'file1';
$dir = '../up/';

if( isset( $_FILES[$key] ) ){
	$file = $_FILES[$key];
	if( $file['error'] ==0 ){
		$pathName = $dir.$file['name'];
		$urlName = 'http://127.0.0.1/blog/up/'.$file['name'];
		$is = move_uploaded_file( $file['tmp_name'],$pathName );
		
		if( !$is ){
			die('上传失败');
		}

		$json = array(
			'success'=> true,
			'msg' => '',
			'file_path' => $urlName
			);
		echo json_encode( $json );
	}
}

