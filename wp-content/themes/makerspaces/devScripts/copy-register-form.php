<?php
/* 
 * This devscript will copy entries from form 2 (the old register form for makerspaces) into 
 * form 5 (the new register form for makerspaces)
 */
echo 'Copy Register Form<br/>';
include 'db_connect.php';

// these fields are copied over as they are
$fieldsToCopy = array(1,2,9,10,11, 12, 13, 89, 91, 92,93,86,84,87,15.1,15.2,15.3,15.4,15.5,15.6,15.7,15.8,15.11,16,65, 67, 68, 74, 66);
    
/*       Field calculations
Field 15 "What days is the makerspace open?"
   15.9 : Saturday    
      if    15.9  =  Sunday
      Then  15.9  =  Saturday
 
Field 96 "Is the makerspace located in or accessed through a:"
   96.1 : School
      if    14    =  Community College Workspace
                     High School Workspace
                     Middle School Workspace
                     Elementary School Workspace
      If    60    =  'K12 School' or 
                     'University'
   96.2 : Library
      If    60    = 'Library'
   96.3 : Community Center
      if    14    =  Community Center Workspace      
   96.4 : Corporation / Business
      If    60    = Company
 
Field 97 "What kind of school?"    
   97.1 : Elementary
      if 14 = Elementary School Workspace   
   97.3 : Middle School
      if 14 = Middle School Workspace
   97.4 : High School
      if 14 = High School Workspace
   97.5 : Community College
      if 14 = Community College Workspace
   
Field 98 - Does it cost money to use this makerspace?
   98 =  Yes
      * 17 =  We charge a daily fee to access the space
               A membership is required to gain access to the space
               We have membership packages available, but users can access the space for a daily fee as well
               We charge a daily fee to access the space
               We charge a usage fee based on the equipment/facility a person wants to utilize
   98 = No
      *  17 =  We do not charge for access to our space but donations are greatly appreciated

Field 99 What kind of fees?
   99.1 : Membership Fees
      * 17 = A membership is required to gain access to the space
      * 17 = We have membership packages available, but users can access the space for a daily fee as well
   99.2 : Usage Fees
      * 17 = We charge a usage fee based on the equipment/facility a person wants to utilize
   99.3 : Daily Fees
      * 17 = We have membership packages available, but users can access the space for a daily fee as well
      * 17 = We charge a daily fee to access the space
   99.4 : Equipment Fees
      * 17 = We charge a usage fee based on the equipment/facility a person wants to utilize
   
Field 102 - Does the makerspace offer safety and basic use training?
   Yes, training is offered for most equipment
      * 23 = Yes, safety and basic use classes are offered for all equipment
      * 34 - We have a safety overview for the entire shop
      * 34 = We only offer safety training per machine
   Yes, training is offered and required for most equipment
    * 24 = Yes, users are required to pass our classes on the equipment before they are able to use it
    * 24 = Yes, but users may bypass taking a class if they are able to pass an aptitude test
   No
      * 23 = No, at this time the Makerspace does not offer classes on its equipment
      * 34 = No, but we encourage safe practices throughout the shop 
      * 24 = Classes are not required to use the equipment

Field 103 - What kind of classes does the makerspace offer?
   103.1 : Skill-building Workshops
      * 25 = Yes
      * 49.7 = Skill Building Workshops  
   103.2 : Certification Programs
   103.3 : Other
   103.4 : None
      * 20 = No 
 * 
 
Field 105 - Does the makerspace provide safety equipment (goggles, welding gloves & jackets, ear protection, etc.)? 
   Yes, for all equipment
      * 33 = We provide all appropriate safety gear for our users
   Yes, for some equipment
   Users must provide their own safety equipment
      * 33 = Users must bring their own safety gear
Field 106 - Does the makerspace host community events?
   Yes
      49.1 : Presentations
      49.2 : Build Sessions
      49.3 : Show & Tell
      49.4 : New Project Nights
      49.5 : Meet & Greet
      49.6 : Pizza & Beer
      49.7 : Skill Building Workshops
      49.8 : Competitions
      49.9 : Open Make Sessions
      49.11 : Maker Faire Participation
      49.12 : Other
Field 107 - Does the makerspace have a kitchen for use by members?
   No
      * 46 = No
   Yes, for personal use by staff and members
      * 46 = Yes
   Yes, for food projects and cooking classes

Field 123 - Does the makerspace offer:
   123.1 : 3D Printers
      * 70 = Yes
   123.2 : 3D Scanners
   123.3 : Laser Cutters
      * 71 = Yes
   123.4 : CNC Cutters
      * 71 = Yes
   123.5 : Vinyl Cutters
      * 72 = Yes
   123.6 : Water Jet
      * 73 = Yes

Field 125 - Tools/materials provided for:
   125.1 : Silk Screening
      * 75 = Yes
 */

// These fields are copied over to different fields in form 5
$copyWithMods = array("14", "15.9", "17", "20", "23", "25", "33", "34", "46", "49.1", "49.2", "49.3", "49.4", "49.5", "49.6", "49.7", "49.8", "49.9", "49.11", "49.12", "60", "70", "71", "72", "73", "75");

// Pull all form 2 entris
global $wpdb;
$table = 'wp_gf_entry';
$sql = "select * FROM wp_gf_entry WHERE form_id = '2'";
$mspaces = $wpdb->get_results($sql);
$count = 0;

//loop thru each of the entries in form 2
foreach($mspaces as $row){   
   $orig_entry_id = $row->id;
   //create a copy in form 5      
   $data = array( 'form_id' => '5', 'date_created' => $row->date_created,
                  'date_updated' => $row->date_updated, 'ip' => $row->ip, 'source_url' => $row->source_url, 
                  'user_agent' => $row->user_agent, 'currency' => $row->currency, 'created_by' => $row->created_by, 'status' => $row->status
               );
   $format = array('%s','%s','%s','%s','%s','%s','%s','%s','%s');
   $wpdb->insert($table,$data,$format);
   
   $faire = $wpdb->get_results($sql);
   $entry_id = $wpdb->insert_id;
   
   //Pull the meta data
   $meta_sql = "select * from wp_gf_entry_meta where entry_id = $orig_entry_id";
   $meta_data = $wpdb->get_results($meta_sql);
   $insert_array = array();
   //loop thru the meta data from form 2
   foreach($meta_data as $meta){         
      $field_number = $meta->meta_key;
      $meta_value   = $meta->meta_value;
      if(in_array($field_number, $fieldsToCopy)){
         $insert_array[] = array($field_number, $meta_value);
      }else{
         if(in_array($field_number, $copyWithMods)){  
            switch ($field_number) {
               case '14':
                  switch ($meta_value) {                                          
                     case "Community Center Workspace":  
                        $insert_array[] = array('96.3', 'Community Center'); //96.3 : Community Center
                        break;
                     case "Community College Workspace":
                        $insert_array[] = array('96.1', 'School'); //96.1 : School
                        $insert_array[] = array('97.5', 'Community College'); //97.5 : Community College
                        break;
                     case "High School Workspace":
                        $insert_array[] = array('96.1', 'School'); //96.1 : School
                        $insert_array[] = array('97.4', 'High School'); //97.4 : High School
                        break;
                     case "Middle School Workspace":
                        $insert_array[] = array('96.1', 'School'); //96.1 : School
                        $insert_array[] = array('97.3', 'Middle School');//97.3 : Middle School
                        break;
                     case "Elementary School Workspace":
                        $insert_array[] = array('96.1', 'School'); //96.1 : School
                        $insert_array[] = array('97.1', 'Elementary'); //97.1 : Elementary
                        break;
                  }
                  
                  break;
               case '15.9':
                  if($meta_value == 'Sunday') $insert_array[] = array('15.9', 'Saturday');
                  break;
               case '60':    
                  switch ($meta_value) {                   
                     case 'K12 School':
                     case 'University':
                        $insert_array[] = array('96.1', 'School'); //96.1 : School
                        break;
                     case 'Library':
                        $insert_array[] = array('96.2', 'Library'); //96.2 : Library
                        break;
                     case 'Company':
                        $insert_array[] = array('96.4', 'Corporation / Business'); //96.4 : Corporation / Business
                        break;
                  }
                  case '17':
                     switch ($meta_value) {
                        case 'We charge a daily fee to access the space':
                        case 'A membership is required to gain access to the space':                           
                        case 'We have membership packages available, but users can access the space for a daily fee as well':                           
                        case 'We charge a daily fee to access the space':
                        case 'We charge a usage fee based on the equipment/facility a person wants to utilize':
                           $insert_array[] = array('98', 'Yes'); 
                           break;
                        case 'We do not charge for access to our space but donations are greatly appreciated';
                           $insert_array[] = array('98', 'No'); 
                        break;
                     }
                     if($meta_value == 'A membership is required to gain access to the space' or
                        $meta_value == 'We have membership packages available, but users can access the space for a daily fee as well')
                        $insert_array[] = array('99.1', 'Membership Fees'); 
                     if($meta_value == 'We charge a usage fee based on the equipment/facility a person wants to utilize')
                        $insert_array[] = array('99.2', 'Usage Fees'); 
                     if($meta_value == 'We have membership packages available, but users can access the space for a daily fee as well' or
                        $meta_value == 'We charge a daily fee to access the space')
                           $insert_array[] = array('99.3', 'Daily Fees'); 
                     if($meta_value == 'We charge a usage fee based on the equipment/facility a person wants to utilize')
                        $insert_array[] = array('99.4', 'Equipment Fees');      
                     break; //17
                  case '23';
                     if($meta_value == 'Yes, safety and basic use classes are offered for all equipment')
                        $insert_array[] = array('102', 'Yes, training is offered for most equipment');      
                     if($meta_value == 'No, at this time the Makerspace does not offer classes on its equipment')
                        $insert_array[] = array('102', 'No');      
                     break;
                  case '24';  
                     if($meta_value == 'Yes, users are required to pass our classes on the equipment before they are able to use it' or
                        $meta_value == 'Yes, but users may bypass taking a class if they are able to pass an aptitude test')
                        $insert_array[] = array('102', 'Yes, training is offered and required for most equipment');                           
                     if($meta_value == 'Classes are not required to use the equipment')
                        $insert_array[] = array('102', 'No');  
                     break; 
                  case '20':
                     if($meta_value == 'No')
                        $insert_array[] = array('103.4', 'None');  //103.4 : None
                     break;   
                  case '25':
                     if($meta_value == 'Yes')
                        $insert_array[] = array('103.1', 'Skill-building Workshops');  
                     break;
                  case '33':
                     if($meta_value == 'We provide all appropriate safety gear for our users')
                        $insert_array[] = array('105', 'Yes, for all equipment');
                     if($meta_value == 'Users must bring their own safety gear')
                        $insert_array[] = array('105', 'Users must provide their own safety equipment');
                     break;
                  case '34':
                     if($meta_value == 'We have a safety overview for the entire shop' or
                        $meta_value == 'We only offer safety training per machine')
                        $insert_array[] = array('102', 'Yes, training is offered for most equipment');  
                     if($meta_value == 'No, but we encourage safe practices throughout the shop')
                        $insert_array[] = array('102', 'No');  
                     break;
                  case '46':
                     if($meta_value == 'No')
                        $insert_array[] = array('107', 'No');  //Field 107 - No
                     if($meta_value == 'Yes')
                        $insert_array[] = array('107', 'Yes, for personal use by staff and members');  //Field 107 - No      
                     break;
                  case '49.7':
                     if($meta_value == 'Skill Building Workshops')
                        $insert_array[] = array('103.1', 'Skill-building Workshops');  
                     break;   
                  case '49.1':
                  case '49.2':
                  case '49.3':
                  case '49.4': 
                  case '49.5':
                  case '49.6':
                  case '49.7':
                  case '49.8':
                  case '49.9':
                  case '49.11':
                  case '49.12':
                     $insert_array[] = array('106', 'Yes');  // Field 106 - Yes
                     break;
                  case '70':
                     if($meta_value == 'Yes')
                        $insert_array[] = array('123.1', '3D Printers');  //123.1 : 3D Printers
                     break;
                  case '71':
                     if($meta_value == 'Yes') {
                        $insert_array[] = array('123.3', 'Laser Cutters'); //123.3 : Laser Cutters
                        $insert_array[] = array('123.4', 'CNC Cutters'); //123.4 : CNC Cutters
                     }
                     break; 
                  case '72':
                     if($meta_value == 'Yes')
                        $insert_array[] = array('123.5', 'Vinyl Cutters');  //123.5 : Vinyl Cutters
                     break;   
                  case '73':
                     if($meta_value == 'Yes')
                        $insert_array[] = array('123.6', 'Water Jet');  //123.6 : Water Jet
                     break;      
                  case '75':
                     if($meta_value == 'Yes')
                        $insert_array[] = array('125.1', 'Silk Screening');  //125.1 : Silk Screening
                     break;         
            }
         }
      }      
   }
   
   //now add to wp_gf_entry_meta
   foreach($insert_array as $insert){
      $meta_sql = "insert into wp_gf_entry_meta (`form_id`, `entry_id`, `meta_key`, `meta_value`) "
                                   . "   VALUES (5, $entry_id, $insert[0], $insert[1])";
      //echo $meta_sql.'<br/>';
              
      $meta = $wpdb->get_results($meta_sql);
   }
         
   //Copy the entry notes
   $notes_sql = "Insert into wp_gf_entry_notes ( `entry_id`, `user_name`, `user_id`, `date_created`, `value`, `note_type`, `sub_type`)
                  SELECT  ".$entry_id.", `user_name`, `user_id`, `date_created`, `value`, `note_type`, `sub_type`
                  FROM wp_gf_entry_notes
                  WHERE entry_id = ".$orig_entry_id;
   $notes = $wpdb->get_results($notes_sql);
   
   //Add a record to save the orignal entry id
   $meta_sql = "insert into wp_gf_entry_meta (`form_id`, `entry_id`, `meta_key`, `meta_value`) "
                                   . "VALUES (5, $entry_id, 'orig_entry_id', $orig_entry_id)";
   $meta = $wpdb->get_results($meta_sql);
   $count++;
}

echo $count .' records copied';