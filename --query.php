<?php

function select_query($getitem, $tblnm, $arr=array(), $orderby="", $extra="")

{	

	global $dlink;

	$qry="select ".$getitem." from ".$tblnm." where 1";

	

	if(!empty($arr))

	{

		foreach ($arr as $key => $val)

			$qry.=" and ".$key."'".$val."'";

	}

	if($orderby!="")

		$qry.=" order by ".$orderby;



	if($extra!="")

		$qry.=$extra;

	//echo $qry; exit;

	$result=$dlink->query($qry);

	return $result;

}

function fetch_query($getitem, $tblnm, $arr=array(), $orderby="")

{ 

	global $dlink;

	 $qry="select ".$getitem." from ".$tblnm." where 1";

	if(!empty($arr)) {

		foreach ($arr as $key => $val)

			$qry.=" and ".$key."'".$val."'";

	}

	if($orderby!="")

		$qry.=" order by ".$orderby;

	$result=$dlink->query($qry);

	if($result->num_rows>0)

	{

		return $result->fetch_array();

	}

	else

		return $dlink->connect_errno;

		

	

	//exit;

}



function update_query($arr, $id, $tblnm)

{

	global $dlink;

	$i=0;

	$qry="update ".$tblnm." set ";

	foreach ($arr as $key => $val)

	{

		if($i!=0)

			$qry.=",";

		$qry.=" `".$key."`='".$val."'";

		$i++;

	}

	if($id!="")

	$qry.=" where ".$id;



	//echo $qry;
	//exit;

	return $dlink->query($qry);

}

function insert_query($arr, $tblnm)

{

	global $dlink; $field=''; $value='';

	foreach ($arr as $key => $val)

	{

		$field.=",`".$key."`";

		$value.=",'".$val."'";

	}

	$qry="insert into ".$tblnm."(".substr($field,1).") values (".substr($value,1).")";

	//echo $qry; exit;

	return $dlink->query($qry);

}

function session()

{

	if($_SESSION['unsuc']!="")

	{

		echo '<div class="alert alert-danger" style="background-color: #fb7f88cc; border-color: #c91f2c; color: #d72734;"><span> '.$_SESSION['unsuc'].' </span></div>';

		$_SESSION['unsuc']="";

	}

}

function session_succ()

{

	if($_SESSION['suc']!="")

	{

		echo '<div class="alert alert-success" style="background-color: #ace09c; border-color: #7ae43a; color: #318d23;"><span> '.$_SESSION['suc'].' </span></div>';

		$_SESSION['suc']="";

	}

}

function session_client()

{

	if(isset($_SESSION['msg'])!="")

	{

		echo '<table border="0" style="color:#FF0000" cellspacing="0" cellpadding="0" class="msgtext" align="center"><tr><td>'.$_SESSION['msg'].'</td></tr></table>';



		$_SESSION['msg']="";

	}

}

function delete_query($tblnm, $arr=array())

{

	global $dlink;

	$qry="delete from ".$tblnm." where 1";

	foreach ($arr as $key => $val)

		$qry.=" and ".$key."'".$val."'";

	return $dlink->query($qry);

}



?>