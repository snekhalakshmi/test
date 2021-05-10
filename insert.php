<?php

$con=mysqli_connect("localhost","root","","datas");
if($con)
{
	$file=$_FILES['csvfile']['tmp_name'];
	$handle=fopen($file,"r");
	$i=0;
	while(($cont=fgetcsv($handle,1000,","))!==false)
	{
		$table=rtrim($_FILES['csvfile']['name'],".csv"); 
		if($i==0)
		{
		$id=$cont[0];	
		$name=$cont[1];
		$dep=$cont[2];
		$sal=$cont[3];
		$query="CREATE TABLE $table($id INT(5),$name VARCHAR(50),$dep VARCHAR(10),$sal INT(5))";
		echo $query,"<br>";
		mysqli_query($con,$query);
		}
		else
		{
			$query="INSERT INTO $table ($id,$name,$dep,$sal) VALUES('$cont[0]','$cont[1]','$cont[2]','$cont[3]')";
			echo $query,"<br>";
			mysqli_query($con,$query);
		}
		$i++;
	}
	
}
else
{
	echo "connection failed";
}


?>