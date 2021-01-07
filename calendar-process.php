<?php
date_default_timezone_set('Asia/Manila');
include('config.php');
$pid = $_POST['pid'];
$select = mysqli_query($con, "SELECT * FROM `tb_id_patients` WHERE id_pid='$pid'") or die(mysqli_error($con));
    while($row=mysqli_fetch_assoc($select)){
        $pid = $row['id_pid'];
        $firstname = $row['id_firstname'];
        $middlename = $row['id_middlename'];
        $lastname = $row['id_lastname'];
        $fullname = ucfirst($firstname). ' '. ucfirst($lastname) .' ' .ucfirst($middlename);
    }
function build_calendar($month,$year) {

// Create array containing abbreviations of days of week.
$daysOfWeek = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

// What is the first day of the month in question?
$firstDayOfMonth = mktime(0,0,0,$month,1,$year);

// How many days does this month contain?
$numberDays = date('t',$firstDayOfMonth);

// Retrieve some information about the first day of the
// month in question.
$dateComponents = getdate($firstDayOfMonth);

// What is the name of the month in question?
$monthName = $dateComponents['month'];

// What is the index value (0-6) of the first day of the
// month in question.
$dayOfWeek = $dateComponents['wday'];

// Create the table tag opener and day headers

$calendar = "<table class='table table-bordered table-dark'>";
$calendar .= "<tr><td colspan='8'><h2 class='mb-0 text-center'>$monthName</h2></td></tr>";
$calendar .= "<tr>";

// Create the calendar headers

foreach($daysOfWeek as $day) {
     $calendar .= "<th class='header'>$day</th>";
} 

// Create the rest of the calendar

// Initiate the day counter, starting with the 1st.

$currentDay = 1;

$calendar .= "</tr><tr>";

// The variable $dayOfWeek is used to
// ensure that the calendar
// display consists of exactly 7 columns.

if ($dayOfWeek > 0) { 
     $calendar .= "<td class='x' colspan='$dayOfWeek'>&nbsp;</td>"; 
}

$month = str_pad($month, 2, "0", STR_PAD_LEFT);

while ($currentDay <= $numberDays) {

     // Seventh column (Saturday) reached. Start a new row.

     if ($dayOfWeek == 7) {

          $dayOfWeek = 0;
          $calendar .= "</tr><tr>";

     }
     
     $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
     
     $date = "$year-$month-$currentDayRel";
    global $con;
    global $fullname;
    global $pid;
        $query = mysqli_query($con, "SELECT * FROM `tb_id_medical_info` WHERE mi_init_date='$date' AND id_pid='$pid'") or die(mysqli_error($con));
        $select = mysqli_query($con, "SELECT * FROM `tb_id_patients` WHERE id_pid='$pid'")or die(mysqli_error($con));
        while($row=mysqli_fetch_assoc($select)) {
            $id_registrationdate = $row['id_registrationdate'];
            $id_registrationdate = date('Y-m-d', strtotime($id_registrationdate));
        }
    if(mysqli_num_rows($query)<>0) {
        $diary_entry='';
        
        while($row=mysqli_fetch_assoc($query)) {
            
            $miid = $row['miid'];
            $mi_init_date = $row['mi_init_date'];
            $mi_disease = $row['mi_disease'];
            $mi_room = $row['mi_room'];
            $mi_chief_complaint = $row['mi_chief_complaint'];
            $mi_physician = $row['mi_physician'];
            $mi_nurse = $row['mi_nurse'];
            $mi_init = $row['mi_init'];
            ($mi_init=='yes')? $mi_init = 'Initial Checkup' : $mi_init = $mi_init; //title
            $mi_procedure = $row['mi_procedures'];
            $mi_medication = $row['mi_medications'];
            //replace split count
            $mi_physician = preg_replace('/["{}]/', '',$mi_physician);
            $mi_physician = preg_replace('/[0-9]+:/', '',$mi_physician);
            $pClass = preg_replace('/[\.\s]/', '-', $mi_physician);
            
            $mi_physician = preg_split('/,/',$mi_physician);
            $pClass = preg_split('/,/',$pClass);
            
            $doctor = "";
            for($i=0;$i<count($mi_physician);$i++) {
                //query doctor name = 
                $query = mysqli_query($con, "SELECT d_userid, CONCAT(d_fname,' ', d_lname,' ', d_mname) AS fullname FROM tb_doctor WHERE d_userid='$mi_physician[$i]'ORDER BY fullname") or die(mysqli_error($con));
                while($row=mysqli_fetch_assoc($query)){
                    $a = $row['fullname'];
                    $doctor.="<div class='input-group mb-1 $pClass[$i]' data-id='$pClass[$i]'><div class='input-group-append w-100 border border-dark'><input type='text' class='form-control rounded-0' name='aphysician' id='aphysician' data-type='aphysician' value='$a' readonly><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeP' data-val='$pClass[$i]'><i class='fas fa-minus'></i></span></div></div>";
                    
                }
                
            #$doctor.= $mi_physician[$i];
            }

            $doctor.="";
            #var_dump($mi_physician);
            $mi_nurse = preg_replace('/[^A-Za-z0-9\-\s\,]/', '', $mi_nurse);
            $mi_nurse = preg_replace('/[0-9]+Name/', 'Name', $mi_nurse);
            $mi_nurse = preg_replace('/Name /', '', $mi_nurse);
            $mi_nurse_name = preg_replace('/ Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}+ End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse); 
            $mi_end = preg_replace('/[A-Za-z]| Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);
            $mi_start = preg_replace('/[A-Za-z]| End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);
            
            $mi_nurse_name = preg_split('/,/',$mi_nurse_name);
            $mi_start = preg_split('/,/',$mi_start);
            $mi_end = preg_split('/,/',$mi_end);
            $nurse="";
            for($i=0;$i<count($mi_nurse_name);$i++) {
                
                #$nurse.= "<div class='form-group pb-0 pt-0 $nameClass[$i]' data-name='$mi_nurse_name[$i]' data-start='$mi_start[$i]' data-end='$mi_end[$i]'><div class='input-group mb-1 border border-dark'><input type='text' class='form-control' name='anurse' id='anurse' data-type='anurse' value='$mi_nurse_name[$i]' readonly><input type='text' class='form-control' name='astart' id='astart' data-type='astart' value='$mi_start[$i]' readonly><input type='text' class='form-control' name='aend' id='aend' data-type='aend' value='$mi_end[$i]' readonly><div class='input-group-append'><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeN' data-val='$nameClass[$i]'><i class='fas fa-minus'></i></span></div></div></div>";
                $nurse.= "<div class='input-group mb-1 border border-dark $nameClass[$i]' data-name='$mi_nurse_name[$i]' data-start='$mi_start[$i]' data-end='$mi_end[$i]'><input type='text' class='form-control' name='anurse' id='anurse' data-type='anurse' value='$mi_nurse_name[$i]' readonly><input type='text' class='form-control' name='astart' id='astart' data-type='astart' value='$mi_start[$i]' readonly><input type='text' class='form-control' name='aend' id='aend' data-type='aend' value='$mi_end[$i]' readonly><div class='input-group-append'><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeN' data-val='$nameClass[$i]'><i class='fas fa-minus'></i></span></div></div>";
            }
            $nurse.="";
            
            $loop = '<h2 class="cursor"><span class="btn btn-primary viewMedInfo" data-month="'.$monthName.'"data-target="#viewMedInfo" data-toggle="modal" data-name="'.$fullname.'" data-miid="'.$miid.'" data-piid="'.$pid.'" data-date="'.$mi_init_date.'" data-disease="'.$mi_disease.'" data-room="'.$mi_room.'" data-chiefc="'.$mi_chief_complaint.'" data-physician="'.$doctor.'" data-nurse="'.$nurse.'" data-procedure="'.$mi_procedure.'" data-medication="'.$mi_medication.'" data-entry="'.$mi_init.'" data-procedure="'.$mi_procedure.'" data-medication="'.$mi_medication.'">'.$mi_init.'</span></h2>';
            ;
            //for($i=0;$i<count($mi_physician);$i++) {}
            
            $diary_entry .= $loop;
        }
        
        $calendar .='<td class="day o" rel='.$date.'><p>'.$currentDay.'</p>'.$diary_entry.'</td>';
        #$calendar .='<td class="day o" rel='.$date.'><p>'.$currentDay.'</p>'.$diary_entry.'<h2 class="cursor"><span class="btn btn-success addMedInfo" data-target="#addMedInfo" data-toggle="modal" data-piid="'.$pid.'" data-date="'.$date.'" data-room="'.$mi_room.'" data-disease="'.$mi_disease.'" data-chiefc="'.$mi_chief_complaint.'" data-physician="'.$doctor.'" data-nurse="'.$nurse.'"><i class="fas fa-plus"></i> Add Entry</span></h2></td>';
        
        $calendar .='';
    } else {
        $query = mysqli_query($con, "SELECT * FROM `tb_id_medical_info` WHERE id_pid='$pid'") or die(mysqli_error($con));
        #if(mysqli_num_rows($query)<>0) {
            while($row=mysqli_fetch_assoc($query)) {
                $miid = $row['miid'];
                $mi_init_date = $row['mi_init_date'];
                $mi_room = $row['mi_room'];
                $mi_chief_complaint = $row['mi_chief_complaint'];
                $mi_disease = $row['mi_disease'];
                $mi_physician = $row['mi_physician'];
                $mi_nurse = $row['mi_nurse'];
                $mi_init = $row['mi_init'];
                ($mi_init=='yes')? $mi_init = 'Initial Checkup' : $mi_init ='x'; //title
                //replace split count
                $mi_physician = preg_replace('/["{}]/', '',$mi_physician);
                $mi_physician = preg_replace('/[0-9]+:/', '',$mi_physician);
                $pClass = preg_replace('/[\.\s]/', '-', $mi_physician);
                
                $mi_physician = preg_split('/,/',$mi_physician);
                $pClass = preg_split('/,/',$pClass);
                $doctor = "";
                for($i=0;$i<count($mi_physician);$i++) {
                    //query doctor name = 
                    $query = mysqli_query($con, "SELECT d_userid, CONCAT(d_fname,' ', d_lname,' ', d_mname) AS fullname FROM tb_doctor WHERE d_userid='$mi_physician[$i]'ORDER BY fullname") or die(mysqli_error($con));
                    while($row=mysqli_fetch_assoc($query)){
                        $a = $row['fullname'];
                        $doctor.="<div class='input-group mb-1 $pClass[$i]' data-id='$pClass[$i]'><div class='input-group-append w-100 border border-dark'><input type='text' class='form-control rounded-0' name='aphysician' id='aphysician' data-type='aphysician' value='$a' readonly><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeP' data-val='$pClass[$i]'><i class='fas fa-minus'></i></span></div></div>";
                        
                    }
                    
                #$doctor.= $mi_physician[$i];
                }
                $doctor.="";
                #var_dump($mi_physician);
                $mi_nurse = preg_replace('/[^A-Za-z0-9\-\s\,]/', '', $mi_nurse);
                $mi_nurse = preg_replace('/[0-9]+Name/', 'Name', $mi_nurse);
                $mi_nurse = preg_replace('/Name /', '', $mi_nurse);
                $mi_nurse_name = preg_replace('/ Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}+ End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse); 
                $nameClass = preg_replace('/ Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}+ End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse); 
                $nameClass = preg_replace('/[\.\s]/', '-', $nameClass); 
                $mi_end = preg_replace('/[A-Za-z]| Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);
                $mi_start = preg_replace('/[A-Za-z]| End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);
                
                $mi_nurse_name = preg_split('/,/',$mi_nurse_name);
                $mi_start = preg_split('/,/',$mi_start);
                $mi_end = preg_split('/,/',$mi_end);
                $nameClass = preg_split('/,/',$nameClass);
                
                $nurse="";
                for($i=0;$i<count($mi_nurse_name);$i++) {
                    
                   #$nurse.= "<div class='form-group pb-0 pt-0 $nameClass[$i]' data-name='$mi_nurse_name[$i]' data-start='$mi_start[$i]' data-end='$mi_end[$i]'><div class='input-group mb-1 border border-dark'><input type='text' class='form-control' name='anurse' id='anurse' data-type='anurse' value='$mi_nurse_name[$i]' readonly><input type='text' class='form-control' name='astart' id='astart' data-type='astart' value='$mi_start[$i]' readonly><input type='text' class='form-control' name='aend' id='aend' data-type='aend' value='$mi_end[$i]' readonly><div class='input-group-append'><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeN' data-val='$nameClass[$i]'><i class='fas fa-minus'></i></span></div></div></div>";
                    $nurse.= "<div class='input-group mb-1 border border-dark $nameClass[$i]' data-name='$mi_nurse_name[$i]' data-start='$mi_start[$i]' data-end='$mi_end[$i]'><input type='text' class='form-control' name='anurse' id='anurse' data-type='anurse' value='$mi_nurse_name[$i]' readonly><input type='text' class='form-control' name='astart' id='astart' data-type='astart' value='$mi_start[$i]' readonly><input type='text' class='form-control' name='aend' id='aend' data-type='aend' value='$mi_end[$i]' readonly><div class='input-group-append'><span class='input-group-text btn btn-danger rounded-0 border-0' id='removeN' data-val='$nameClass[$i]'><i class='fas fa-minus'></i></span></div></div>";
                }
                $nurse.="";
            }
            if(strtotime($date)<=strtotime($id_registrationdate)) {
                $calendar .= '<td class="day o" rel='.$date.'><p>'.$currentDay.'</p></td>';
            } else {
                $calendar .= '<td class="day o" rel='.$date.'><p>'.$currentDay.'</p><h2 class="cursor"><span class="btn btn-success addMedInfo" data-target="#addMedInfo" data-toggle="modal" data-miid="'.$miid.'" data-piid="'.$pid.'" data-date="'.$date.'" data-room="'.$mi_room.'" data-disease="'.$mi_disease.'" data-chiefc="'.$mi_chief_complaint.'" data-physician="'.$doctor.'" data-nurse="'.$nurse.'"><i class="fas fa-plus"></i> Add Entryx</span></h2></td>';
            }
    }//end else

     // Increment counters

     $currentDay++;
     $dayOfWeek++;

}

// Complete the row of the last week in month, if necessary

if ($dayOfWeek != 7) { 

     $remainingDays = 7 - $dayOfWeek;
     $calendar .= "<td class='x' colspan='$remainingDays'>&nbsp;</td>"; 

}

$calendar .= "</tr>";

$calendar .= "</table>";

return $calendar;

}
$dateComponents = getdate();
$month = $_POST['month'];	     
$year = $_POST['year'];
$monthName = $dateComponents['month'];
echo build_calendar($month,$year);
?>