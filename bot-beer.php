<?php
	$content = file_get_contents('php://input');//รับข้อมูลจากไลน์
	$events = json_decode($content, true);//แปลง json เป็น php
	if(!is_null($events['events'])) //check ค่าในตัวแปร $events
	{
		foreach ($events['events'] as $event)
		{
			if($event['type'] == 'message' && $event['message']['type'] == 'text'))
			{
				
			}
			
		}
		
	}
	
?>