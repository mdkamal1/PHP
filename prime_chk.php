<?php  
//for a number to another
for ($i=2; $i < 20 ; $i++) { 
	for ($j=2; $j < $i+1 ; $j++) { 
		if ($i%$j==0) 
		{
			if ($i>$j) 
			{
				break;
			}
			else
			echo "$i is a prime number<br>";
		}
	}
}

// user defined function to check prime
 function prime_chk($i)
 {
	for ($j=2; $j < $i+1 ; $j++) 
	{ 
		if ($i%$j==0) 
		{
			if ($i>$j) 
			{
				echo "$i is not a prime number<br>";
				break;
			}
			else
			{
				echo "$i is a prime number<br>";
			}
		}
	}
}
prime_chk(3);




//to find prime number to a specific number of count
$x=1;
$i=2;
for ($count=0; $count < 10 ; $i++) 
{ 
	for ($j=2; $j < $i+1 ; $j++) 
	{ 
		if ($i%$j==0) 
		{
			if ($i>$j) 
			{
				break;
			}
			else
			{
				echo "$x.  $i is a prime number<br>";
				$count++;
				$x++;
			}
		}
	}
}

?>