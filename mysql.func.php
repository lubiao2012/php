<?php
/*
 * 连接数据库
 * 返回连接资源符
 */
function connect(){
	$link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
	if(mysqli_connect_errno()){
		printf("connect failed:%s\n",mysqli_connect_error());
		exit();
	}
	mysqli_set_charset($link, DB_CHARSET);
	return $link;
}

/*
 * 向数据库中插入元素
 * 返回插入的元素的id
 * */
function insert($link, $table , $array){
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	#$sql="insert into ({$table}) ({$keys}) values ({$vals})";
	$sql="insert into $table ($keys)values({$vals})";
	echo $sql;
	mysqli_query($link, $sql);
	return mysqli_insert_id($link);
}

/*
 * 更新数据库中的数据
 * 返回更新的行数*/
function update($link,$table , $array,$where=null){
	$str='';
	foreach($array as $key=>$val){
		if($str==''){
			$sep='';
		}else{
			$sep=',';
		}
		$str=$str.$sep.$key."="."'".$val."'";
	}	
	$sql="update $table set {$str}".($where==null?"":(" where ".$where));
	echo $sql;
	mysqli_query($link , $sql);
	return mysqli_affected_rows($link);
}

/*删除数据库中的数据
 * 返回影响的行数*/
function delete($link , $table , $where =null){
	$sql = "delete from $table ".($where==null?"":(" where ".$where));
	mysqli_query($link, $sql);
	return mysqli_affected_rows($link);
}

/*
 * 根据sql查询一行结果
 * 返回一个关联数组
 * */
function fetchOne($link , $sql , $result_type=MYSQL_ASSOC){
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result, $result_type);
	return $row;
}

/*
 * 根据sql查询多行结果
 * 返回一个存放关联数组的数组
 * */
function fetchAll($link , $sql , $result_type=MYSQL_ASSOC){
	$result = mysqli_query($link,$sql);
	while(@$row=mysqli_fetch_array($result, $result_type)){
		$rows[]=$row;
	}
	return $rows;
}

/*
 * 根据sql查看结果的行数
 * */
function getResultNum($link , $sql){
	$result = mysqli_query($link , $sql);
	return mysqli_num_rows($result);
}








