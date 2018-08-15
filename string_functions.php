<?php  

//NOTE----- OUTPUT FOR BOOLEAN VALUE TRUE IS 1  &&   OUTPUT FOR BOOLEAN VALUE FALSE IS NOTHING i.e.,EMPTY         

$string="welcome to php";

//1.strlen():- use to find the length of the string
echo strlen($string);
echo "<br>";

//2.strrev():- use to write the string in reverse order
echo strrev($string);
echo "<br>";

//3.strtoupper():- to convert the string in upeercase
echo strtoupper($string);
echo "<br>";

//4.strtolower():- to convert the string in lowercase 
echo strtolower($string);
echo "<br>";

//5.ucfirst():- to convert the first letter of the string as capital
echo ucfirst($string);
echo "<br>";

//6.ucwords():- to convert the first letter of each word in string as capital
echo ucwords($string);
echo "<br>";

//7.ord():- to return ASCII value passing character
echo ord('a');
echo "<br>";

//8.chr():- to return character passing ASCII value
echo chr(97);
echo "<br>";

//9.trim():- to remove unwanted spaces from both ends of the string
$str1="  welcome to php  ";
echo "string length before trim-- ".strlen($str1); 
$trim=trim($str1);
echo "string length after trim-- ".strlen($trim);  
echo "<br>";

//10.ltrim():- to remove unwanted spaces from left side of the string only 
$str2=" welcome to php";
echo "string length before ltrim-- ".strlen($str2); 
$ltrim=ltrim($str2);
echo "string length after ltrim-- ".strlen($ltrim); 
echo "<br>";

//11.rtrim():- to remove unwanted spaces from right side of the string only
$str3="welcome to php ";
echo "string length before rtrim-- ".strlen($str3);
$rtrim=rtrim($str3);
echo "string length after rtrim-- ".strlen($rtrim);
echo "<br>";

//12.strip_tags():- to remove html codes from the string
$str4="welcome <b>to</b> php";
echo strip_tags($str4);
echo "<br>";

//13.addslashes():- to add slashes infront of invalid single or double quotes
$str5="welco'me to php";
echo addslashes($str5);
echo "<br>";

//14.stripslashes():- to remove slashes added by the addslashes() function
$str6=stripcslashes($str5);
echo $str6;
echo "<br>";

//15.addcslashes():- to add slashes infront of desired character  USE--  addcslashes('string','desired character')
$str7="welcome";
echo addcslashes($str7,'l');
echo "<br>";

//16.stripcslashes():- to remove slashes added by the addcslashes() function
$str8=stripcslashes($str7);
echo $str8;
echo "<br>";

//17.substr():- to get a substring from a given string  USE--substr('string','starting index','no of characters')
echo substr($string,3,5);
echo "<br>";

//18.strstr():- to get a string from another string  USE-- strstr('string','starting character')
echo strstr($string, 'c');
echo "<br>";


//19.stristr() :- same as strstr() but is case insensitive
echo stristr($string, 'C');
echo "<br>";

//20.str_shuffle():- to shuffle a string  NOTE-- with every refresh the value change
echo str_shuffle($string);
echo "<br>";


//21.isset():- to check whether variable contains some value or not  NOTE-- output is boolean i.e, either true or false 
$a=10;
$b=20;
if (isset($a) && isset($b)) {
	echo $a + $b;
}
echo "<br>";

//22.empty() :- to check whether variable contains empty value or not  NOTE-- output is boolean i.e, either true or false 
$c=10;
echo empty($a);
echo "<br>";


//23.str_replace():- to replace a substring with another one in the string  
//USE--str_replace('replacing substring','to whom to be replaced','string')
echo str_replace('php', 'mysql', $string);
echo "<br>";


//24.str_ireplace():- same as str_replace() but case-insensitive
echo str_ireplace('MYSQL', 'php', $string);
echo "<br>";


//25.strpos():- to find the position of the character in the string   NOTE-- always give the position of thr first occuring character
echo strpos($string, 't');
echo "<br>";

//26.strrpos() :- sane as strpos() but look for the character from last
echo strrpos($string, 'e');
echo "<br>";


//27.str_split():- to divide a string into a number of character  USE-- str_split('string','length of desired substrins')  
//NOTE-- return type is an array
print_r (str_split($string,2));
echo "<br>";


//28.explode():- to divide a string based on common character  USE--explode('common character','string')  NOTE-- return type is an array
print_r(explode(" ", $string));
echo "<br>";

//29.implode():- to add commin character between the array elements  USE--implode('char to join','array') NOTE--return type is string
$array=['welcome','to','php'];
echo implode(" ", $array);
echo "<br>";


//30.exit():- to stop the execution of the statement
$x=10;
$y=20;
echo $x;
exit();
echo $y;
echo "<br>";


?>