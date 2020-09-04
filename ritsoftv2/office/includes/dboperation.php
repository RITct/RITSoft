<?php
$dbHost = '127.0.0.1';
$dbUsername = 'ritsoftv2';
$dbPassword = 'ritsoftv2';
$dbName = 'ritsoftv2';
error_reporting(0);
$con1=mysql_connect("127.0.0.1","ritsoftv2","ritsoftv2" );
mysql_select_db('ritsoftv2');

class dboperation
{
	var $con;
	var $result;
	var $r;
	var $id;
	public function Ex_query($query)
	{
		$con=mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
		$this->result=mysqli_query($con,$query);
	
		if($this->result>0)
		{	
			return 1;
		}
		else
		{
			return 0;
		}
		
		
	}
	function selectdata($query)
	{
		$con=mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
		if($result=mysqli_query($con,$query))
		{
			return $result;
		}
	
	}
	function fetch($result)
	{
		$r=mysqli_fetch_array($result,MYSQLI_BOTH);
		return $r;
	}
	function fetch_all($query)
	{	$rows= array();
	$con=mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
		$result=mysqli_query($con,$query);
		 while($row = $result->fetch_assoc())
		 {
             $rows[] = $row;
    	}
    	return $rows;
	
	}
	function getnextId($table_name)
	{
		$con=mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2","ritsoftv2");
		$result_stat = mysqli_query($con,"SHOW TABLE STATUS LIKE '$table_name'");
	
		$row_stat = mysqli_fetch_array($result_stat,MYSQLI_BOTH);
		$id = $row_stat['Auto_increment'];
		return $id; 
	}
	
	
};
?>
