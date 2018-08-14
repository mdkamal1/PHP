<?php  

// for single value check
function chk($x)
{
	if ($x%2==0) 
	{
		echo $x." is even"."<br>";
	}else
	{
		echo $x." is odd"."<br>";
	}
}
chk(9);
chk(3);
chk(2);
chk(10);


// for multiple value check
for ($i=0; $i <20 ; $i++) { 
	if ($i%2==0) 
	{
		echo $i." is even"."<br>";
	}else
	{
		echo $i." is odd"."<br>";
	}
}

?>