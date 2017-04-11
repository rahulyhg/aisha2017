<?php include('Crypto.php');?>
<?php

if(isset($_GET['payment']))
{
    header('Location:'.$server.'/index.php?option=com_astrologin&task=astroask.confirmCCPayment&payment=fail&token='.$token.'&email='.$email);
}
else
{
	$workingKey='143063E52AFFE0A6170B547A9E7CEAE1';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}
        
	if($order_status==="Success")
	{
            $values = array("yes");
            for($i = 0; $i < $dataSize; $i++) 
            {
                $information=explode('=',$decryptValues[$i]);
                //echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
                array_push($values, $information[1]);

            }
            
            $token_number           = "token_".$values[1];
            $ccavenue_track_id      = $values[2];
            $ccavenue_bank_ref      = $values[3];
            $ccavenue_order_status  = $values[4];
            header('Location:'.$server.'/index.php?option=com_astrologin&task=astroask.confirmCCPayment&token='.$token_number.'&track_id='.$ccavenue_track_id.'&bank_ref='.$ccavenue_bank_ref.'&status='.$ccavenue_order_status);
                
	}
      	else if($order_status==="Aborted")
	{
		header('Location:'.$server.'/index.php?option=com_astrologin&task=astroask.confirmCCPayment&token='.$token_number.'&track_id='.$ccavenue_track_id.'&bank_ref='.$ccavenue_bank_ref.'&status='.$ccavenue_order_status);
	}
	else if($order_status==="Failure")
	{
		header('Location:'.$server.'/index.php?option=com_astrologin&task=astroask.confirmCCPayment&token='.$token_number.'&track_id='.$ccavenue_track_id.'&bank_ref='.$ccavenue_bank_ref.'&status='.$ccavenue_order_status);
	}
	else
	{
		echo "<br>Security Error. Illegal access detected. Please wait while you are redirected.";
                header('Refresh: 5; url=http://www.astroisha.com/ask-question');
	
	}

	echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";
}
?>
