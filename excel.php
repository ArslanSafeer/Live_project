<?php
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'live_project');
$output='';
if (isset($_POST['export_excel'])){
	$sql="SELECT * FROM project_detail";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)){

		$output.='
<table class="table" bordered="1">
<tr>
<th>id</th>
<th>Date</th>
<th>Attended By</th>
<th>Detail</th>
<th>Project Id</th>
</tr>

		';
		while($row=mysqli_fetch_array($result)){

			$output.='
<tr>
<td>'.$row['Project_detail_id'].'</td>
<td>'.$row['date'].'</td>
<td>'.$row['attended_by'].'</td>
<td>'.$row['detail'].'</td>
<td>'.$row['project_id'].'</td>

</tr>
			';
		}

		$output .='</table>';
		header("content-Type:application/xls");
		header("content-Disposition:attachment; filename=download.xls");
		echo $output;
	}
}

?>