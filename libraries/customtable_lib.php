<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
if(!class_exists("Customtable_lib"))
{
	class Customtable_lib
	{
		function __construct()
		{
			//echo "called";die;
		}
		
		private $status = array();
		public $tableLabel = array();
		public $tableVals = array();
		public $dateTimeFormat = "d-m-Y H:i:s a";		
		/**
		* @author Ibad
		* This function will format the data to be passed directly to the table viewer 
		* @param string $tableLabel The $tableLabel is a string containing the haeding of the table
		* @param array $tableCols The $tableCols is an array of the column nams of the table with keys same as database columns
		* @param array $tableVals $table Vals is an array of all the table cells (from the database)
		* @param array $status  The $status is an array that contains status_variable_name (containing the name of the status column) and data that contains the different values for states (active,inative,pending,danger) and text for them
		* @param array $action The $action is an array containing the btns key (view,edit,delete) and corresponding text related to them. Also link and the link column value
		* 
*/
		function formatTableCells($tableLabel = "",$tableCols=array(),$tableVals=array(),$status=array(),$actions=array())
		{			
			if(empty($status))
			{
				$status = $this->status;
			}
			if(empty($tableLabel))
			{
				$tableLabel = $this->tableLabel;
			}
			if(empty($tableVals))
			{
				$tableVals = $this->tableLabel;
			}
		//	echo "<pre>";print_r($status);die;
			$tableData['tableLabel'] = $tableLabel;
			$tableData['tableHeadings'] = array();
			$tableKeys = array();	
			if(isset($actions["checkbox"]))
			{
				$tableData["checkbox"] = $actions["checkbox"];
			}		
			foreach($tableCols as $keys=>$cols)
			{
				$tableData['tableHeadings'][] = $cols;
				$tableKeys[] = $keys;
			}
			if(!empty($actions))$tableData['tableHeadings'][] = "Actions";
						
			$status_vars = array();
			
			foreach($status as $var)		
			{
				$status_vars[] = $var['varname'];
			}			
			$entries = array();	
			$cnt = 0;
			$statuscnt = 0;
			if($tableVals)
			{
				foreach($tableVals as $vals)
				{
					if(isset($actions["checkbox"]))
					{
						$entries[$cnt]['mmmmcheckbox'] = array("type"=>"checkbox","id"=>$vals[$actions["checkbox"]]);
					}
					foreach($tableKeys as $dbcols)
					{
						if(!(in_array($dbcols,$status_vars)))
						{							
							if(preg_match("/_date/",$dbcols) && ($vals[$dbcols] != NULL || $vals[$dbcols] != ""))
							{
								$vals[$dbcols] = standard_date("DATE_time",strtotime($vals[$dbcols]));
							}
							$entries[$cnt][$dbcols]["type"] = "";
							$entries[$cnt][$dbcols]["data"] = $vals[$dbcols];
						}
						else
						{
							//Logic to add status type
							foreach($status as $stat)
							{
								if($dbcols == $stat['varname'])
								{
									$entries[$cnt][$dbcols]["type"] = "status";
									$statuscal = array();
									foreach($stat['statusvals'] as $key=>$value)
									{
										if($key == $vals[$dbcols])
										{
											$statuscal['type'] = $value["value"];
											$statuscal['text'] = $value["text"];
										}									
									}
									$entries[$cnt][$dbcols]["data"] = $statuscal;
								}							
							}
						}					
					}
					//Logic to add action data
					if(!(empty($actions)))
					{
						$actionsData = array();						
						foreach($actions["btns"] as $key=>$btns)
						{
							$actionsData[$key]['type'] = $btns;
							$actionsData[$key]['text'] = $actions["text"][$key];
							$actionsData[$key]['link'] = str_replace("%@$%",$vals[$actions["dbcols"][$key]],$actions["link"][$key]);
							$actionsData[$key]['modal'] = (isset($actions["clickable"][$key]))?$actions["clickable"][$key]:"";
							$actionsData[$key]['id'] = $vals[$actions["dbcols"][$key]];							
						}
						$entries[$cnt]["action"]["type"] = "actions";
						$entries[$cnt]["action"]["data"] = $actionsData;
						
					}
					$cnt++;
				}	
			}
			$actionsData = array();						
			foreach($actions["btns"] as $key=>$btns)
			{
				$actionsData[$key]['type'] = $btns;
				$actionsData[$key]['text'] = $actions["text"][$key];
				$actionsData[$key]['link'] = $actions["link"][$key];
				$actionsData[$key]['modal'] = (isset($actions["clickable"][$key]))?$actions["clickable"][$key]:"";
				$actionsData[$key]['id'] = "%@$%";							
			}
			$tableData['actionbtns'] = $actionsData;			
			$tableData['tableEntries'] = $entries;
	//		die;			
	//		echo "<pre>";print_r($tableData);die;
	//		include("views/helpers/members_table_view.php");
			return $tableData;
		}
		
		public function createStatus($varname,$statusvals)
		{
			$status = array();
			$status["varname"] = $varname;
			$status["statusvals"] = $statusvals;
			$this->status[] = $status;
		}
		
	}
}

/**
 $status = array(
			 0=>array(
				["varname"]=>"dbcolumnname",
			 	["statuvals"]=>array(
			 							[0] => array(
			 											["value"] =>"active",
			 											["text"] => "Active"
			 										),
			 							[1] =>array(
			 											["value"] =>"inactive",
			 											["text"] => "Inactive"
			 										)
			 						)			
			        )				
			 );
//Example for arrangement of data

			$tablecells[0]['type'] = "";
			$tablecells[0]['data'] = "ibadgore";
			
			$tablecells[1]['type'] = "";
			$tablecells[1]['data'] = "22/09/1988";
			
			$tablecells[2]['type'] = "";
			$tablecells[2]['data'] = "PHP Developer";
			
			$tablecells[3]['type'] = "status";
			$tablecells[3]['data'] = array("type"=>"active","text"=>"Active");
			
			$actions = array();
			$actions[0]['type'] = "view";
			$actions[0]['text'] = "View";
			$actions[0]['link'] = base_url();
			
			$actions[1]['type'] = "edit";
			$actions[1]['text'] = "Edit";
			$actions[1]['link'] = base_url();
			
			$actions[2]['type'] = "delete";
			$actions[2]['text'] = "Delete";
			$actions[2]['link'] = base_url();
			
			$tablecells[4]['type'] = "actions";
			$tablecells[4]['data'] = $actions;
*/
?>