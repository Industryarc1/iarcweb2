<?php
	/*
	###############################################################################
	Created for		: 	http://neo-electronic.com.com/
	Company			: 	Cipra Systems.
	File       		: 	pagedresults.php
	Used By    		: 	All
	Definition 		: 	--
	To use     		: 	This file display page navigaion links
						$res is some sql query.		
						$rs = new MySQLPagedResultSet($res,10);
						$num_rows = $rs->rowNum();
						while ($row = $rs->fetchArray()) {
							// db output
						}
						the page navigation link is displayed by the following code
						$rs->getPageNav($query_var);
	###############################################################################
	*/

class MySQLPagedResultSet
{
	var $results;
	var $pageSize;
	var $page;
	var $row;
	
	function MySQLPagedResultSet($query,$pageSize)
	{
		global $resultpage;
		$resultpage=$_GET['resultpage'];
		
		$this->results = @mysql_query($query);
		$this->pageSize = $pageSize;
		if ((int)$resultpage <= 0) $resultpage = 1;
		if ($resultpage > $this->getNumPages())
		$resultpage = $this->getNumPages();
		$this->setPageNum($resultpage);
	}
	
	function getNumPages()
	{
		if (!$this->results) return false;
		
		return ceil(mysql_num_rows($this->results) /
				(float)$this->pageSize);
	}
	
	function rowNum()
	{
		if (!$this->results) return false;
		
		return mysql_num_rows($this->results);
	}
	
	function setPageNum($pageNum)
	{
		if ($pageNum > $this->getNumPages() or
		$pageNum <= 0) return false;
		
		$this->page = $pageNum;
		$this->row = 0;
		mysql_data_seek($this->results,($pageNum-1) * $this->pageSize); 
	}
	
	function getPageNum()
	{
		return $this->page;
	}
	
	function isLastPage()
	{
		return ($this->page >= $this->getNumPages());
	}
	
	function isFirstPage()
	{
		return ($this->page <= 1);
	}
	
	function fetchArray()
	{
		if (!$this->results) return false;
		if ($this->row >= $this->pageSize) return false;
		$this->row++;
		return mysql_fetch_array($this->results);
	}
	
	function getPageNav($queryvars = '')
	{
		$nav = "";
		if (!$this->isFirstPage())
		{
			$nav .= "<a href=\"?resultpage=".
				  ($this->getPageNum()-1).'&'.$queryvars.'"  ><u>Prev</u></a> <  ';			
		}
		else
		{
			if ($this->getNumPages() == 1)
				$nav .= " Prev < 1 ";
			else
				$nav .= " Prev < ";
		}
		if ($this->getNumPages() > 1)
		for ($i=1; $i<=$this->getNumPages(); $i++)
		{
			if ($i==$this->page)
			  $nav .= " <span  class=\"links1\"> $i </span> ";
			else
			  $nav .= "<a href=\"?resultpage={$i}&".
					  $queryvars."\" class='links1'><u>{$i}</u></a> ";
			//($this->pageSize * ($i-1)) '-' ($i*$this->pageSize)
			// . '-' . $this->pageSize			
		}
		if (!$this->isLastPage())
		{
			$nav .= " > <a href=\"?resultpage=".
				  ($this->getPageNum()+1).'&'.$queryvars.'" ><u>Next</u></a> ';			
		}
		else
		{
			$nav .= " > Next ";
		}
		if (isset($nav)){
			
			return $nav;
		} 
	}
}

?>