<!-- output functions -->
	<!-- 1.echo();
		2.print();
		3.printf();
		4.sprintf();
		5.print_r(); 
	-->

<?php 

echo "welcome"," to php";	//two stings can be connected using either ',' or '.'
echo "<br>";	//used to break the line


print "welcome"." to php";	//two stings can be connected using only '.'
echo "<br>";


// printf();	use to print output same as C language
$name="kamal";
$num=2;
printf("%s has %d houses",$name,$num);
echo "<br>";


//sprintf();	it only return the output but never print it. 
$name="kamal";
$num=2;
$return=sprintf("%s has %d houses",$name,$num); //retun the value to $return
echo $return;	//we simply then echo the result
echo "<br>";


//print_r();	used to print the arrays
$arr=array("kamal","aaditya","gupta","sourabh");
print_r($arr);


?>