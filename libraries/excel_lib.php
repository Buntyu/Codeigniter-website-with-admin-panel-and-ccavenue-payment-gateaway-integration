<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class excel_lib 
{
	function __construct()
	{
		require_once 'phpexcel/Classes/PHPExcel.php';
	}	
	function writeExcel($headings = array(), $data = array(), $filename = "mysheet" ,$pages = 1, $titles = array(),$dates = array())
	{
		if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');
		$alphabets = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");		
		$pages = intval($pages);	
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator(COMPANYNAME)
									 ->setLastModifiedBy(COMPANYNAME)
									 ->setTitle("Created By - ".COMPANYNAME)
									 ->setSubject("Created By - ".COMPANYNAME)
									 ->setDescription(COMPANYNAME." - Excel Sheet for use")
									 ->setKeywords(COMPANYNAME)
									 ->setCategory(COMPANYNAME);								 
		for($page = 1; $page<=$pages; $page++)
		{
			$curindex = $page-1;
			$db_name = array_keys($headings[$curindex]);
			if($curindex!=0)
			{
				$objPHPExcel->createSheet($curindex);
			}
			// Add some data
			$objPHPExcel->setActiveSheetIndex(0);			
			$ncols = count($headings[$curindex]);	
			//For Headings		
			for($i = 0; $i<$ncols; $i++)
			{
				$headings[$curindex][$db_name[$i]] = str_replace("&nbsp;"," ",$headings[$curindex][$db_name[$i]]);
				$headings[$curindex][$db_name[$i]] = str_replace("<strong>","",$headings[$curindex][$db_name[$i]]);
				$headings[$curindex][$db_name[$i]] = str_replace("</strong>","",$headings[$curindex][$db_name[$i]]);
				$headings[$curindex][$db_name[$i]] = str_replace("<br />","",$headings[$curindex][$db_name[$i]]);
				$headings[$curindex][$db_name[$i]] = str_replace("<br/>","",$headings[$curindex][$db_name[$i]]);
				$objPHPExcel->setActiveSheetIndex($curindex)->setCellValue($alphabets[$i]."1", $headings[$curindex][$db_name[$i]]);
				if(in_array($i,$dates))
				{
					$objPHPExcel->setActiveSheetIndex($curindex)->getStyle($alphabets[$i])->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
				}	
				$objPHPExcel->getActiveSheet()->getStyle($alphabets[$i]."1")->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle($alphabets[$i]."1")->getFont()->setBold(true);		
			}		
			if(isset($data[$curindex]) && !(empty($data[$curindex])))
			{
				$curdata = $data[$curindex];
				$nrows = count($headings[$curindex]);				
				$rownum = 2;				
				foreach($curdata as $cur_line)
				{					
					for($j=0; $j<$nrows; $j++)
					{					
						$cur_line[$db_name[$j]] = str_replace("&nbsp;"," ",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("<strong>","",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("</strong>","",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("<b>","",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("</b>","",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("<br />"," ",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("<br/>"," ",$cur_line[$db_name[$j]]);
						$cur_line[$db_name[$j]] = str_replace("<br>"," ",$cur_line[$db_name[$j]]);
						$objPHPExcel->setActiveSheetIndex($curindex)->setCellValue($alphabets[$j].($rownum), $cur_line[$db_name[$j]]);
		//				echo $cur_line[$db_name[$j]]."<br />";
						if(in_array($j,$dates))
						{
							$objPHPExcel->setActiveSheetIndex($curindex)->getStyle($alphabets[$j].($rownum))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
						}						
					}//die;
					$rownum++;
				}
				
			}			
		//	die;
			
			// Rename worksheet
			if(isset($titles[$curindex]))
			{
				$objPHPExcel->getActiveSheet()->setTitle($titles[$curindex]);
			}
			else
			$objPHPExcel->getActiveSheet()->setTitle('My WorkSheet');	
		}		
		
	//	$objPHPExcel->createSheet(1);
		
		// Rename worksheet
	//	$objPHPExcel->getActiveSheet()->setTitle('Complex');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.".xlsx".'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}	
	
	function readExcel($inputFileName = "",$extension = "",$requiredfields = array(),$uniquefields = array(),$contains = array())
	{
		include 'phpexcel/Classes/PHPExcel/IOFactory.php';		
		
		
		if($extension == 'xls')	
		{
			$objReader = new PHPExcel_Reader_Excel5();
		}
		else if($extension == 'xlsx')
		{
			$objReader = new PHPExcel_Reader_Excel2007();
		}
		else if($extension == 'csv')
		{
			$objReader = new PHPExcel_Reader_CSV();
		}
		else		
		{
			return FALSE;
		}
			
		//	$objReader = new PHPExcel_Reader_Excel2003XML();
		//	$objReader = new PHPExcel_Reader_OOCalc();
		//	$objReader = new PHPExcel_Reader_SYLK();
		//	$objReader = new PHPExcel_Reader_Gnumeric();		
	//	$inputFileName = "Testing PHP EXCEL.xlsx";
		$objReader->setLoadAllSheets();
		$objPHPExcel = $objReader->load($inputFileName);
		
		
	//	echo $objPHPExcel->getSheetCount();
	/*	$loadedSheetNames = $objPHPExcel->getSheetNames();
		foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
			echo $sheetIndex,' -> ',$loadedSheetName,'<br />';
		}
	*/	
		$numSheets = $objPHPExcel->getSheetCount();
		$loadedSheetNames = $objPHPExcel->getSheetNames();
		$sheetData = array();
		for($i =0; $i<$numSheets; $i++)
		{
			$objPHPExcel->setActiveSheetIndex($i);
			$sheetData[] = $objPHPExcel->getActiveSheet()->toArray(null,true,true,FALSE);			
		}
	//	echo "<pre>"; print_r($sheetData);	die;
		$indcnt = 0;	
		$setcont = FALSE;
		$msheetData = array();
				
		$failedreq = array();
		$failedunique = array();
		$failedcont = array();		
		foreach($sheetData as $ind=>$sheet)
		{
			$unique = isset($uniquefields[$ind]) ? $uniquefields[$ind] : array();
			$tmp_unique = array();			
			foreach($unique as $i=>$v){$tmp_unique[$v]=array();}
			$unique = $tmp_unique;					
			$required = isset($requiredfields[$ind]) ? $requiredfields[$ind] : array();
			foreach($sheet as $index=>$rows)
			{
				$cnt = 0;				
				foreach($rows as $colnum=>$cols)
				{
					if($setcont)
					{
						continue;
					}
					if(isset($unique[$colnum]) && is_array($unique[$colnum]))
					{
						if(in_array($cols,$unique[$colnum]))
						{
						//	echo "not unique for".$cols." ".$index."-".$colnum."<br />";
							if($cols != "")
							$failedunique[] = array('sheet'=>$loadedSheetNames[$ind],'row'=>$index-1,'column'=>$colnum);
							unset($sheetData[$ind][$index]);
							$setcont = TRUE;
							continue;
						}
						$unique[$colnum][] = $cols;						
					}
					if(isset($contains[$ind][$colnum]) && !in_array($cols,$contains[$ind][$colnum]) && $index != 0)
					{
					//	echo "not contains for".$cols." ".$index."-".$colnum."<br />";
						if($cols != "")
						$failedcont[] = array('sheet'=>$loadedSheetNames[$ind],'row'=>$index-1,'column'=>$colnum);
						unset($sheetData[$ind][$index]);
						$setcont = TRUE;
						continue;
					}
					if($cols == "")
					{
						$sheetData[$ind][$index][$colnum] = "";
						$cnt++;
					} 
					if($required == "all" || in_array($colnum,$required) && $cols == "")
					{
					//	echo "not required for"." ".$index."-".$colnum."<br />";
						$failedreq[] = array('sheet'=>$loadedSheetNames[$ind],'row'=>$index-1,'column'=>$colnum);
						unset($sheetData[$ind][$index]);
						$setcont = TRUE;
					}					
				}							
				if(intval($cnt) == count($rows))
				{
					unset($sheetData[$ind][$index]);
					$indcnt++;
					$setcont = TRUE;
				}
				if($setcont)
				{
					$setcont = FALSE;
					$indcnt++;
					continue;
				}
				$msheetData[$ind][$index-$indcnt] = $sheetData[$ind][$index];
			}
		}
	//	echo "<pre>";print_r($unique);die;
		return array("data"=>$msheetData,"required"=>$failedreq,"contains"=>$failedcont,"unique"=>$failedunique);		
	}
}

?>