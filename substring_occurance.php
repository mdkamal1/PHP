<pre>
	<?php  

	$string="gold gold gold silver silver";

	function substr_occur($string,$len){
		$str="";
		for ($i=0; $i < strlen($string) ; $i++) { 
			if ($string[$i]!==" ") {
				$str=$str.$string[$i];
			}
		}
		for ($i=0; $i < strlen($str)-($len-1) ; $i++) 
		{ 
			$sub = '';
			for ($j=0; $j < $len ; $j++) { 
				$sub= $sub.$str[$i+$j];

			}
			$st[] = $sub;
		}	
		unset($sub);
		foreach ($st as $value) 
		{
			$position=[];
			$pos_last=0;
			while(($pos_last = strpos($str,$value,$pos_last)) !== false) 
			{
				$position[]=$pos_last;
				$pos_last = $pos_last + strlen($value);
			}
			if(count($position)>1)
			{ 
				$sub[]=$value;
				$count[]=count($position);
			}
		}
		if (isset($sub)) {
			$new_sub_array = array_unique($sub);
			for ($i=0; $i < strlen($str)-($len-1) ; $i++) { 
				if (!empty($new_sub_array[$i])) {
					$new_array[]=$new_sub_array[$i];	
				}	
			}
			$count_new = count($new_array);
			for($j=0; $j < $count_new ;$j++)
			{
				$new_count[]=$count[$j];
			}
			?><table border="2" align="center"><?php
			for($x=0; $x < $count_new ; $x++)
			{
				?><tr><td><?php
				echo "'".$new_array[$x]."'"." is repeated ".$new_count[$x]. " times";
				?></td></tr><?php
			}
			?></table><?php
		}else
		echo "no string is repeated";
	}

	substr_occur("$string",4);

	?>