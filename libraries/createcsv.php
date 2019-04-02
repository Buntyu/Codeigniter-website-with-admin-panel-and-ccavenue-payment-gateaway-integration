<?php
class Createcsv
{
	public function create($headings = array(),$body = array(),$filename = "")
	{
		if(!$filename)$filename = "list_".date("d-m-Y").".csv";
		header('Content-Type:application/excel');
		header('Content-Disposition:attachment; filename="'.$filename.'"');
		$fp=fopen('php://output','w');
		$keys = array_keys($headings);
		$values = array_values($headings);
		fputcsv($fp,$values);
		foreach($body as $val)
		{
			$values = array();
			foreach($keys as $key)
			{								
				$values[] = $val[$key];
			}
			fputcsv($fp,$values);
		}
		fclose($fp);
	}
}
?>