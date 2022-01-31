<?php include("connection.php");

include("query.php");

include('../smtp/fun.php');
	
if($_POST['action']=='quiz_publish')

{

	global $dlink;
		
		$query ="UPDATE quiz SET publish='".$_POST['val']."' WHERE id=".$_POST['qid'];
		$result1 = $dlink->query($query);
		if($result1)
		{
			echo 'succcess';
			
		}
	else
	echo 'fail';

	exit;

}	
	
			

//-------------member verified by admin------------------

if($_POST['action']=='member_verified')

{

	global $dlink;
	if($_POST['sttype']=='true')
	{	
		$query ="UPDATE member SET verified='1',viewed_by_admin='1' WHERE id=".$_POST['mid'];
		$result1 = $dlink->query($query);
		if($result1)
		{
			
			/*$to = $_POST['email'];
			$from = "info@medicozcommunity.com";
			$subject = 'Congratulation Your Account Approved - ABC';
			$message = '<div style="background:#ED3237; border:1px solid #000;width:630px">
				<div style="color:#fff; font:bold 16px Arial, Helvetica, sans-serif; padding:10px 0 10px 8px">Congratulation Your Account Approved - ABC</div>
					<div style="background:#FFFFFF; border:1px solid #000; margin:0 5px 5px; padding:15px 10px 5px;">
					<table>
					<tr>
						<td valign="top" colspan="2"><b>You are succesfully verified by Admin. Now you can login into to your account.</b></td>
					</tr>
					<tr>
						<td valign="top" colspan="2"><a href="'.$front_url.'">Go To Site</a></td>
					</tr>
					</table>
				</div></div>';
				
				$headers = "From: $from\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$chk_mail=DoEmail($to,$subject,trim($message),"",$from,'Congratulation Your Account Approved - ABC');
				if( $chk_mail )
				{	*/
					echo "upd";
					exit;
				/*}
				else
				{
					echo "notupd";
					exit;
				}*/
		}
	}

	else if($_POST['sttype']=='false')
	{	
		$query ="UPDATE member SET verified='0' WHERE id=".$_POST['mid'];
		$result1 = $dlink->query($query);
		if($result1)
		{
			echo "upd";
			exit;
		}

	}

	exit;

}



//---------------events venue add - get state-------------------------



if($_POST['action']=='get_state')

{

	

	$state=select_query("*","states", array("country_id="=>$_POST["country"]), "name asc");

	?>

	<option value="">Select State</option>

	<?php

		while($st=$state->fetch_array())

		{?>

			<option value="<?php echo $st["id"]; ?>" ><?php echo $st["name"]; ?></option>

	<?php

		}

}



//---------------events venue add - get city-------------------------

if($_POST['action']=='get_city')

{

	$city=select_query("*","cities", array("state_id="=>$_POST["state"]), "name asc");

	?>

	<option value="">Select City</option>

	<?php

		while($ct=$city->fetch_array())

		{?>

			<option value="<?php echo $ct["id"]; ?>" ><?php echo $ct["name"]; ?></option>

	<?php

		}

}





//---------------member post load more data-------------------------



if($_POST['action']=='mem_post_load_data')
{

$no='';



if(isset($_POST['getresult']))

{ $no = $_POST['getresult']; }

	

	$query=select_query("*","member_post","","id desc"," LIMIT $no,3");

	if($query->num_rows > 0)

		{

			//$i=$no+1;

			while($c = $query->fetch_array())

			{ 

				$mem=fetch_query("category,fname","member",array("id="=>$c['mid']));

				if($mem['category']=='1')

				$cat='Guest';

				else

				$cat='Superintendent';

				?>

                <div class="postmain">

                    <img class="postmainimg" src="<?php echo $site_url; ?>img/default.png" width=50/>

                    <span><b><?php echo $mem['fname']; ?></b>  <!--<h6 class="postmainh6">On artikle</h6></span> <a style="font-size: 12px;"> lorem ipsum dolor sit amet</a>-->

                    <p class="postmainp1"><?php echo $c['post_date']; ?></p>

                    <p class="postmainp2">

                        <?php echo stripslashes($c['detail']); ?>

                    </p>

                     <?php

					if($c['image']=='') {

						$postimg='../images/post-1.jpg';

					}

					else

					{

						$postimg='../upimages/'.$c['image'];

					}

					?>

					<img src="<?php echo $site_url; ?><?php echo $postimg; ?>" style="width:238px; margin-bottom:10px;" alt="discuss image">

					<br />

                    <!--<a class="postmainareply">Reply <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a> --> 

                    <a class="postmainaveri" id="mpostveri<?php echo $c['id'] ?>" onclick="change_post_veri(<?php echo $c['id'] ?>)">Case Verification  <i class="fa fa-check-square-o" <?php if($c['verified']=='1'){ ?> style="color:#4dec4d" <?php } ?> id="checkicon<?php echo $c['id'] ?>" aria-hidden="true"></i></a>

                    

                    <?php

					$row5=select_query("*","member_post_like", array("postid="=>$c['id']), "id desc");

					$totallike=$row5->num_rows;

					?>

					<p class="postmainaveri"><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $totallike; ?></p>

                	

                    <?php

					$row8=select_query("*","member_post_comment", array("postid="=>$c['id']), "id desc");

					$totalcomment=$row8->num_rows;

					?>

					<a href="<?php echo $site_url; ?>member-post-detail/<?php echo $c['id']; ?>" class="postmainaveri" target="_blank"><i class="fa fa-comment" aria-hidden="true"></i> <?php echo $totalcomment; ?></a>

                                                

                </div>

                <?php

			}

		}

		

}





//-------------member Post verified by admin------------------

if($_POST['action']=='member_post_verified')

{

	global $dlink;

		$query ="UPDATE member_post SET verified='1' WHERE id=".$_POST['mpid'];

		$result1 = $dlink->query($query);

		if($result1)

		{

			$mem=fetch_query("mid","member_post",array("id="=>$_POST['mpid']));

			$dt = date('Y-m-d H:i:s');

			$arr=array("not_mid"=>$mem['mid'],"not_type"=>'1',"post_id"=>$_POST['mpid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
			$insert = insert_query($arr, "front_notification");

			
			
			
			//display noti to followers
			/*$follower=select_query("*","member_follow", array("followid="=>$mem['mid']), "id desc");
			if($follower->num_rows)
			{
				while($b=$follower->fetch_array())
				{
					$dt = date('Y-m-d H:i:s');
					$arr=array("not_mid"=>$b['followerid'],"not_type"=>'4',"post_id"=>$_POST['mpid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
					$insert = insert_query($arr, "front_notification");
				}
			}*/
			
			//display noti to followers
			$noti_send_to=array();
			$follower=select_query("*","member_follow", array("followid="=>$mem['mid']), "id desc");
			if($follower->num_rows)
			{
				while($b=$follower->fetch_array())
				{
					if(in_array($b['followerid'],$noti_send_to))
					{ }
					else
					{
						$noti_send_to[]=$b['followerid'];
					}
				}
			}
			
			//display noti to followings
			$follower=select_query("*","member_follow", array("followerid="=>$mem['mid']), "id desc");
			if($follower->num_rows)
			{
				while($b=$follower->fetch_array())
				{
					if(in_array($b['followid'],$noti_send_to))
					{ }
					else
					{
						$noti_send_to[]=$b['followid'];
					}
					
				}
			}
			if(!empty($noti_send_to))
			{
				for($i=0;$i<count($noti_send_to);$i++)
				{
					$dt = date('Y-m-d H:i:s');
					$arr=array("not_mid"=>$noti_send_to[$i],"not_type"=>'4',"post_id"=>$_POST['mpid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
					$insert = insert_query($arr, "front_notification");
				}
			}
			//send push notification to mobile
			$mem=fetch_query("device_token","member",array("id="=>$mem['mid']));
			if($mem['device_token']!='')
			{
				$url = "https://fcm.googleapis.com/fcm/send";
				$token = "c-NwRRjx1as:APA91bELH2peIhscExu4UJucoyWPq0TbT5qO-IZNhyaR-WZ7vYcXup19IAi2gUcazJN8tHQbGJ9k80iPN28-qC_IOPEVJ1V0DQXtwCjzSlAlFje-Io1uOej9n-7uqEgwsoV2NAPKCH9K";
				$serverKey = 'AAAAOdXzaIY:APA91bEZiWTpS3bUEJ6KUJ9guyQucGlKk4f3SdU1N0z-uFnhvgAMHnjhdKMMZkHg52ZevV6NNo5oq1AO1ORYrmqDZdwMfwEEalgBxucNaI1Ib93R810-_vWl5DBn0JNeJOIEcf2Wg4ba';
				$title = "Case Verified";
				$body = "Your case verified by admin";
				$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
				$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
				$json = json_encode($arrayToSend);
				$headers = array();
				$headers[] = 'Content-Type: application/json';
				$headers[] = 'Authorization: key='. $serverKey;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
				curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_VERBOSE, 0);
	
				//Send the request
				$response = curl_exec($ch);
				//Close request
				if ($response === FALSE) {
					die('FCM Send Error: ' . curl_error($ch));
				}
				else
				{
					echo "upd";
					exit;
				}
				curl_close($ch);
			}
			else
			{
				echo "upd";
				exit;
			}
		}

		else

		{

			echo "notupd";

			exit;

		}

}



//-------------news verified by admin------------------

if($_POST['action']=='news_verified')

{

	global $dlink;

		$query ="UPDATE news SET verified='1' WHERE id=".$_POST['mnid'];

		$result1 = $dlink->query($query);

		if($result1)

		{

			echo "upd";

			exit;

		}

		else

		{

			echo "notupd";

			exit;

		}

}



//-------------all notification viewed by admin------------

if($_POST['action']=='notification_viewby_admin')

{

	global $dlink;

		$query ="UPDATE admin_notification SET not_read_status='1' WHERE id=".$_POST['notiid'];

		$result1 = $dlink->query($query);

		if($result1)

		{

			echo "upd";

			exit;

		}

		else

		{

			echo "notupd";

			exit;

		}

}





//-------------member Comment verified by admin------------------

if($_POST['action']=='member_comment_verified')

{

	global $dlink;

		$query ="UPDATE member_post_comment SET verified='1' WHERE id=".$_POST['mcid'];

		$result1 = $dlink->query($query);

		if($result1)

		{

			$mem=fetch_query("commentermid,commentmid,postid","member_post_comment,device_token",array("id="=>$_POST['mcid']));

			$dt = date('Y-m-d H:i:s');

			$arr=array("not_mid"=>$mem['commentermid'],"not_type"=>'5',"post_id"=>$mem['postid'],"comment_id"=>$_POST['mcid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
			$insert = insert_query($arr, "front_notification");

			//display noti to followers
			$noti_send_to=array();
			$follower=select_query("*","member_follow", array("followid="=>$mem['commentermid']), "id desc");
			if($follower->num_rows)
			{
				while($b=$follower->fetch_array())
				{
					/*$dt = date('Y-m-d H:i:s');
					$arr=array("not_mid"=>$b['followerid'],"not_type"=>'5',"post_id"=>$_POST['mpid'],"comment_id"=>$_POST['mcid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
					$insert = insert_query($arr, "front_notification");*/
					if(in_array($b['followerid'],$noti_send_to))
					{ }
					else
					{
						$noti_send_to[]=$b['followerid'];
					}
				}
			}
			
			//display noti to followings
			$follower=select_query("*","member_follow", array("followerid="=>$mem['commentermid']), "id desc");
			if($follower->num_rows)
			{
				while($b=$follower->fetch_array())
				{
					if(in_array($b['followid'],$noti_send_to))
					{ }
					else
					{
						$noti_send_to[]=$b['followid'];
					}
					/*$dt = date('Y-m-d H:i:s');
					$arr=array("not_mid"=>$b['followerid'],"not_type"=>'5',"post_id"=>$_POST['mpid'],"comment_id"=>$_POST['mcid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
					$insert = insert_query($arr, "front_notification");*/
				}
			}
			if(!empty($noti_send_to))
			{
				for($i=0;$i<count($noti_send_to);$i++)
				{
					$dt = date('Y-m-d H:i:s');
					$arr=array("not_mid"=>$noti_send_to[$i],"not_type"=>'5',"post_id"=>$mem['postid'],"comment_id"=>$_POST['mcid'],"not_from_id"=>'0',"not_from_type"=>'admin',"not_date"=>$dt,"not_read_status"=>'0',"not_status"=>'0');
					$insert = insert_query($arr, "front_notification");
				}
			}
			if($mem['device_token']!='')
			{
			//send push notification to mobile
			$url = "https://fcm.googleapis.com/fcm/send";
			$token = "c-NwRRjx1as:APA91bELH2peIhscExu4UJucoyWPq0TbT5qO-IZNhyaR-WZ7vYcXup19IAi2gUcazJN8tHQbGJ9k80iPN28-qC_IOPEVJ1V0DQXtwCjzSlAlFje-Io1uOej9n-7uqEgwsoV2NAPKCH9K";
			$serverKey = 'AAAAOdXzaIY:APA91bEZiWTpS3bUEJ6KUJ9guyQucGlKk4f3SdU1N0z-uFnhvgAMHnjhdKMMZkHg52ZevV6NNo5oq1AO1ORYrmqDZdwMfwEEalgBxucNaI1Ib93R810-_vWl5DBn0JNeJOIEcf2Wg4ba';
			$title = "case Verified";
			$body = "Your case verified by admin";
			$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
			$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
			$json = json_encode($arrayToSend);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: key='. $serverKey;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_VERBOSE, 0);

			//Send the request
			$response = curl_exec($ch);
			//Close request
			if ($response === FALSE) {
				die('FCM Send Error: ' . curl_error($ch));
			}
			else
			{
				echo "upd";
				exit;
			}
			curl_close($ch);
			}
			else
			{
				echo "upd";
				exit;
			}

		}

		else

		{

			echo "notupd";

			exit;

		}

}







//---------------member post comment load more data-------------------------


if($_POST['action']=='mem_post_comment_load_data')

{

$no='';



if(isset($_POST['getresult']))

{ $no = $_POST['getresult']; }

	

	$query=select_query("*","member_post","","id desc"," LIMIT $no,3");

	if($query->num_rows > 0)

		{

			//$i=$no+1;

			while($c = $query->fetch_array())

			{ 

				$mem=fetch_query("category,fname","member",array("id="=>$c['mid']));

				if($mem['category']=='1')

				$cat='Guest';

				else

				$cat='Superintendent';

				?>

                <div class="postmain">

                    <img class="postmainimg" src="<?php echo $site_url; ?>img/default.png" width=50/>

                    <span><b><?php echo $mem['fname']; ?></b>  <!--<h6 class="postmainh6">On artikle</h6></span> <a style="font-size: 12px;"> lorem ipsum dolor sit amet</a>-->

                    <p class="postmainp1"><?php echo $c['post_date']; ?></p>

                    <p class="postmainp2">

                        <?php echo stripslashes($c['detail']); ?>

                    </p>

                    <?php

					if($c['image']=='') {

						$postimg='../images/post-1.jpg';

					}

					else

					{

						$postimg='../upimages/'.$c['image'];

					}

					?>

					<img src="<?php echo $site_url; ?><?php echo $postimg; ?>" style="width:238px; margin-bottom:10px;" alt="discuss image">

					<br />

                    <!--<a class="postmainareply">Reply <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a> --> 

                    <!--<a class="postmainaveri" id="mpostveri<?php //echo $c['id'] ?>" onclick="change_post_veri(<?php //echo $c['id'] ?>)">case Verification  <i class="fa fa-check-square-o" <?php //if($c['verified']=='1'){ ?> style="color:#4dec4d" <?php //} ?> id="checkicon<?php //echo $c['id'] ?>" aria-hidden="true"></i></a>-->

                    

                    <?php

					$row5=select_query("*","member_post_like", array("postid="=>$c['id']), "id desc");

					$totallike=$row5->num_rows;

					?>

					<p class="postmainaveri"><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $totallike; ?></p>

                    

                    <!----------------------comment---------------->

                                                

                    <a class="postmainaveri" data-toggle="collapse" data-target="#demo<?php echo $c['id'] ?>"><i class="fa fa-comment" aria-hidden="true"></i> Discuss</a>

                    <!------collapse div--------->

                    <div id="demo<?php echo $c['id'] ?>" class="collapse" style="margin-top:10px;">

                    

                        <?php

                        //$row6=select_query("*","member_post_comment", array("postid="=>$c['id']), "id desc");
						global $dlink;
							$row6 = $dlink->query("select c.* , count(l.id) as cntlike from member_post_comment c LEFT JOIN member_post_comment_like l ON c.id=l.commentid where c.postid='".$c['id']."' and (l.commentid IS NULL or l.commentid IS NOT NULL) group by c.id order by c.verified desc, cntlike desc");

                        while($b6=$row6->fetch_array())

                        {

                            $row7=select_query("*","member", array("id="=>$b6['commentermid']), "id desc");

                            $b7=$row7->fetch_array();

                        ?>

                        <!----------all comment on post---------->

                        <div class="commentmain">

                        <img class="postmainimg" src="<?php echo $site_url; ?>img/default.png" width=50/>

                        <span><b><?php echo $b7['fname']; ?></b>  

                        <p class="postmainp1"><?php echo $b6['comment_date']; ?></p>

                        <p class="postmainp2">

                        	<?php if($b6['image']!='') { ?>

                            	<img src="<?php echo $site_url; ?>../upimages/<?php echo $b6['image']; ?>" style="width:100px; margin-left:5px;" alt="discuss image">

                            <?php } ?>

                            <?php echo stripslashes($b6['comment']); ?>

                        </p>

                        <a class="postmainaveri" id="mcommentveri<?php echo $b6['id'] ?>" onclick="change_comment_veri(<?php echo $b6['id'] ?>)">Discuss Verification  <i class="fa fa-check-square-o" <?php if($b6['verified']=='1'){ ?> style="color:#4dec4d" <?php } ?> id="checkiconcomment<?php echo $b6['id'] ?>" aria-hidden="true"></i></a>

						<?php
						$rowc5=select_query("id","member_post_comment_like", array("postid="=>$c['id'],"commentid="=>$b6['id']), "id desc");
						$totalcommentlike=$rowc5->num_rows;
						?>
						<a class="postmainaveri">Like (<?php echo $totalcommentlike; ?>)</a>
                                                    
                        </div>

                        <!------------// all comment on post---------->
						<?php
						$rowr6=select_query("id,replyermid,postmid,postid,commentid,reply,reply_date","member_post_comment_reply", array("postid="=>$c['id'],"commentid="=>$b6['id']), "id desc");
						if($rowr6->num_rows)
						{
							?>
						<span style="margin-left:133px;"><b>Reply</b></span>
						
							<!------------reply display----------->
							<?php
							
							while($br6=$rowr6->fetch_array())
							{
								$rowr7=select_query("fname,username,category","member", array("id="=>$br6['replyermid']), "id desc");
								$br7=$rowr7->fetch_array();
							?>
							<div class="commentmain" style="margin-left:135px;">
								<img class="postmainimg" src="<?php echo $site_url; ?>img/default.png" width=50/>
								<span><b><?php echo $br7['fname']; ?></b>  
								<p class="postmainp1"><?php echo $br6['reply_date']; ?></p>
								<p class="postmainp2">
								
									<?php echo stripslashes($br6['reply']); ?>
								</p>
							</div>
							<?php } //while ?>
							<!------------//reply dispaly---------->
						 
						<?php
							} //if
							?>
                        <?php

                        }

                        ?>

                    </div>

                     <!--------// collapse div----------->

                                                 

                </div>

                <?php

			}

		}

		

}

?>