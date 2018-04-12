<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	@This function is used for export UTF8 function to csv
*/

class ExportCSV  extends CI_Controller
{ 
	 	public function __construct()
		{
				parent::__construct();
				
		}		
	
	public function index($table){
  ini_set('max_execution_time', 300);
  set_time_limit(-1);


$filename = "customers-".date("Y-m-d H:i:s").'.csv';
 $query = "SELECT * FROM $table";
 $this->load->dbutil();
$this->load->helper('file');
$query = $this->db->query($query );
$delimiter ="\t";
$newline = "\r\n";
$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
//cho $data;
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$data1= chr(255) . chr(254).chr(255) . chr(254).chr(255) . chr(254).chr(255) . chr(254);
$data1 .= mb_convert_encoding($data , 'UTF-16LE', 'UTF-8');
$data = $data1;
echo $data;
exit;
 
}
}// End of Class

?>