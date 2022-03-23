<?php
	$UIDresult=$_POST["UIDresult"];

	require_once 'assets/twilio-php-main/src/Twilio/autoload.php'; 
    use Twilio\Rest\Client; 
    include 'Connection.php';

    if(isset($UIDresult))
    {
        date_default_timezone_set("Asia/Calcutta");
        $Date = date("d/m/Y");
        $Time = date("h:i A");
        $getLogs = "select * from logs where Date = '".$Date."' and SID = '".$UIDresult."' and flags = 0";
        $LogsQuery = mysqli_query($conn,$getLogs);
        $row = mysqli_num_rows($LogsQuery);

        $numberq = "select * from stud_details where SID = '".$UIDresult."'";
        $numberquery = mysqli_query($conn,$numberq);
        $res = mysqli_fetch_array($numberquery);
        $phoneNumber = "+91".$res['Guardians_Number'];

        if($row > 0)
        {
            while($resLogs = mysqli_fetch_array($LogsQuery))
            {
                if($resLogs['flags'] == 0)
                {
                    if($resLogs['Exit_Time'] == "00:00:00")
                    {
                        $q = "update logs set Exit_Time = '".$Time."' , flags = 1 where SID = '".$UIDresult."'";
                        $query = mysqli_query($conn,$q);
                        if($query)
                        {
                            $sid    = "AC50db4c983ee0a453d8804e8e9a19dfdf"; 
                            $token  = "c48a654ac86062fa8bc7b9cdda82c0ff"; 
                            $twilio = new Client($sid, $token); 
                            $message = $twilio->messages 
                                            ->create("whatsapp:$phoneNumber", // to 
                                                    array( 
                                                        "from" => "whatsapp:+14155238886",       
                                                        "body" => "Your ward, *Ohm Patel* Has Left Collage *Date: $Date Time: $Time*", 
                                                    ) 
                                            );
                        }
                    }
                    else
                    {
                        $q = "insert into logs (SID,Date,Entry_Time,flags) values ('".$UIDresult."','".$Date."','".$Time."',0)";
                        $query = mysqli_query($conn,$q);
                        if($query)
                        {
                                $sid    = "AC50db4c983ee0a453d8804e8e9a19dfdf"; 
                                $token  = "c48a654ac86062fa8bc7b9cdda82c0ff"; 
                                $twilio = new Client($sid, $token); 
                                $message = $twilio->messages 
                                                ->create("whatsapp:$phoneNumber", // to 
                                                        array( 
                                                            "from" => "whatsapp:+14155238886",       
                                                            "body" => "Your ward, *Ohm Patel* Has Reached Collage *Date: $Date Time: $Time*", 
                                                        ) 
                                                ); 
                                
                                print($message->sid); 
                                print("ENTRY"); 
                        }
                    }
                }
            }
        }
        else
        {
            $q = "insert into logs (SID,Date,Entry_Time,flags) values ('".$UIDresult."','".$Date."','".$Time."',0)";
            $query = mysqli_query($conn,$q);
            if($query)
            {
                $sid    = "AC50db4c983ee0a453d8804e8e9a19dfdf"; 
                $token  = "c48a654ac86062fa8bc7b9cdda82c0ff"; 
                $twilio = new Client($sid, $token); 
                $message = $twilio->messages 
                                ->create("whatsapp:$phoneNumber", // to 
                                        array( 
                                            "from" => "whatsapp:+14155238886",       
                                            "body" => "Your ward, *Ohm Patel* Has Reached Collage *Date: $Date Time: $Time*", 
                                        ) 
                                ); 
                
                print($message->sid); 
                print("ENTRY"); 
            }
        }
    }
?>