<?php 
include("connection.php");
include("query.php");
$fid=$_REQUEST['fid'];
$id=$_REQUEST['id'];

if($_REQUEST['fid']=='department')
{
	$delete = delete_query('department',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Staff Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."staff-listing");
	exit;
}

if($_REQUEST['fid']=='agent')
{
	//$delete = delete_query('agent',array("id="=>$id));
	$delete = delete_query('dept_branch',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Department Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."department-listing");
	exit;
}
if($_REQUEST['fid']=='branch')
{
	$delete = delete_query('branches',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Branch Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."branch-listing");
	exit;
}
if($_REQUEST['fid']=='expenses')
{
	$delete = delete_query('expenses',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Expense Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."expenses-listing");
	exit;
}
if($_REQUEST['fid']=='customers')
{
	$arr=array("is_delete"=>1);   
	$delete = update_query($arr,"id=".$id,"customers");
	if($delete)
	{
		$_SESSION['suc']='Customers Detail Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."customer-listing");
	exit;
}
if($_REQUEST['fid']=='vendor')
{
	$delete = delete_query('vendor',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Vendor Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."vendor-listing");
	exit;
}
if($_REQUEST['fid']=='bill')
{
	$delete = delete_query('bill',array("id="=>$id));
	if($delete)
	{
		$delete = delete_query('bill_detail',array("bid="=>$id));
		$_SESSION['suc']='Bill Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."bill-listing");
	exit;
}
if($_REQUEST['fid']=='expensetype')
{
	$result = $dlink->query("SELECT * FROM expense_type WHERE parent_id ='".$id."'");
	if($result->num_rows == 0) {
	    $delete = delete_query('expense_type',array("id="=>$id));
		if($delete)
		{
			$_SESSION['suc']='Expense Type Deleted Successfully...';
		}
		else
		{
			$_SESSION['unsuc']='Something Wrong... Try Again...';
		}
	} else {
		
	   $_SESSION['unsuc']='First Delete Sub Category';
	}

	header("location:".$site_url."expense-type-listing");
	exit;
}
if($_REQUEST['fid']=='recordexpense')
{
	$delete = delete_query('record_expense',array("id="=>$id));
	if($delete)
	{
		$_SESSION['suc']='Record Expense Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."record-expense-listing");
	exit;
}
if($_REQUEST['fid']=='creditnote')
{
	$delete = delete_query('credit_note',array("id="=>$id));
	if($delete)
	{
		$delete = delete_query('credit_note_detail',array("bid="=>$id));
		$_SESSION['suc']='Bill Deleted Successfully...';
	}
	else
	{
		$_SESSION['dan']='Something Wrong... Try Again...';
	}
	header("location:".$site_url."credit-note-listing");
	exit;
}
?>