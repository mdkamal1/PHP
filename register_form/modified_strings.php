<?php 


	function modifystr($modify)
	{
		$modified=strip_tags(addslashes(trim($modify)));
		return $modified;
	}

	function modify($modify)
	{
		$modified=ucwords(strtolower(strip_tags(addslashes(trim($modify)))));
		return $modified;
	}

?>