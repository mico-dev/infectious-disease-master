<?php
include('config.php');

$query = $_POST['query'];
$type = $_POST['type'];

//set table name
if($type=='streetBrgy') {
    $table = 'tb_addbrgy';
    $select = 'ab_desc';
} elseif($type=='muniCity') {
    $table = 'tb_addcitymun';
    $select = 'ac_desc';
} elseif($type=='province') {
    $table = 'tb_addprovince';
    $select = 'ap_desc';
} elseif($type=='region') {
    $table = 'tb_region';
    $select = 'reg_desc';

} elseif($type=='country') {
    $table = 'tb_country';
    $select = 'ct_name';
} elseif($type=='physician') {
    $table = 'tb_doctor';
    $select = 'd_fname';
    $physician = mysqli_query($con, "SELECT d_userid, CONCAT(TRIM(d_fname),' ', TRIM(d_lname),' ', TRIM(d_mname)) AS fullname FROM tb_doctor WHERE CONCAT(d_fname,' ', d_lname,' ', d_mname) LIKE '%".$query."%' ORDER BY fullname LIMIT 3") or die(mysqli_error($con));
    $result = '<ul  class="list-group">';
    while ($row =mysqli_fetch_assoc($physician)) {
        $d_userid = $row['d_userid'];
        $result .= '<li class="list-group-item '.$type.'" data-id="'.$d_userid.'">'.$row['fullname'].'</li>';
    }
    $result .= '</ul>';
    echo $result;
    die();
} elseif($type=='nurse') {
    $table = 'tb_staff';
    $nurse = mysqli_query($con, "SELECT staff_un, CONCAT(staff_fname,' ', staff_lname,' ', staff_mname) AS fullname FROM `tb_staff` WHERE staff_deptmain='NSO' AND staff_posvalue=0 AND staff_status='Active' AND CONCAT(staff_fname,' ', staff_lname,' ', staff_mname) LIKE '%$query%' ORDER BY fullname LIMIT 3") or die(mysqli_error($con));
    $result = '<ul  class="list-group">';
    while ($row =mysqli_fetch_assoc($nurse)) {
        $d_userid = $row['staff_un'];
        $fullname = $row['fullname'];
        $result .= '<li class="list-group-item '.$type.'" data-id="'.$d_userid.'">'.ucwords(strtolower($fullname)).'</li>';
    }
    $result .= '</ul>';
    echo $result;
    die();

} elseif($type=='formSubmit') {

    $id_registrationdate = $_POST['id_registrationdate'];
    $id_firstname = $_POST['id_firstname'];
    $id_lastname = $_POST['id_lastname'];
    $id_middlename = $_POST['id_middlename'];
    $id_suffix = $_POST['id_suffix'];
    $id_gender = $_POST['id_gender'];
    $id_birthdate = $_POST['id_birthdate'];
    $id_civilstatus = $_POST['id_civilstatus'];
    $id_contactno = $_POST['id_contactno'];
    $id_houseno = $_POST['id_houseno'];
    $id_brgy = $_POST['id_brgy'];
    $id_city = $_POST['id_city'];
    $id_province = $_POST['id_province'];
    $id_region = $_POST['id_region'];
    $id_country = $_POST['id_country'];

    $insert = mysqli_query($con, "INSERT INTO `tb_id_patients`(`id_registrationdate`, `id_firstname`, `id_lastname`, `id_middlename`, `id_suffix`, `id_gender`, `id_birthdate`, `id_civilstatus`, `id_contactno`, `id_houseno`, `id_brgy`, `id_city`, `id_province`, `id_region`, `id_country`) VALUES ('$id_registrationdate', '$id_firstname', '$id_lastname', '$id_middlename', '$id_suffix', '$id_gender', '$id_birthdate', '$id_civilstatus', '$id_contactno', '$id_houseno', '$id_brgy', '$id_city', '$id_province', '$id_region', '$id_country')") or die(mysqli_error($con));
    if($insert) {
        echo $result ='<div class="alert alert-success text-dark" role="alert"><strong>Success! </strong>Patient is registered successfully</div>';
        die();
    } else {
        //throw error
    }
    
} elseif($type=='mi_insert') {
    //medical info
    $id_pid = $_POST['id_pid'];
    $mi_init_date = $_POST['mi_init_date'];
    $mi_disease = $_POST['mi_disease'];
    $mi_room = $_POST['mi_room'];
    $mi_chief_complaint = $_POST['mi_chief_complaint'];
    $mi_physician = json_encode($_POST['mi_physician'], JSON_FORCE_OBJECT);
    $mi_nurse = json_encode($_POST['mi_nurse'], JSON_FORCE_OBJECT);
    $mi_init = $_POST['mi_init'];
    

    $insert = mysqli_query($con, "INSERT INTO `tb_id_medical_info`(`id_pid`, `mi_init_date`, `mi_disease`, `mi_room`, `mi_chief_complaint`, `mi_physician`, `mi_nurse`, `mi_init`, `mi_procedures`, `mi_medications`) VALUES ('$id_pid', '$mi_init_date', '$mi_disease', '$mi_room', '$mi_chief_complaint', '$mi_physician', '$mi_nurse', '$mi_init', 'n/a', 'n/a')") or die(mysqli_error($con));
    if($insert) {
        echo $result ='<div class="alert alert-success text-dark" role="alert"><strong>Success! </strong>Patient '.$id_pid.' medication information is successfully registered</div>';
        die();
    } else {
        //throw error
    }
} elseif($type=='diary_insert') {
    //diary
    $id_pid = $_POST['id_pid'];
    $mi_init_date = $_POST['mi_init_date'];
    $mi_disease = $_POST['mi_disease'];
    $mi_room = $_POST['mi_room'];
    $mi_chief_complaint = $_POST['mi_chief_complaint'];
    $mi_physician = json_encode($_POST['mi_physician'], JSON_FORCE_OBJECT);
    $mi_nurse = json_encode($_POST['mi_nurse'], JSON_FORCE_OBJECT);
    $mi_init = $_POST['mi_init'];
    $mi_medication = $_POST['mi_medication'];
    $mi_procedure = $_POST['mi_procedure'];
    

    $insert = mysqli_query($con, "INSERT INTO `tb_id_medical_info`(`id_pid`, `mi_init_date`, `mi_disease`, `mi_room`, `mi_chief_complaint`, `mi_physician`, `mi_nurse`, `mi_init`, `mi_procedures`, `mi_medications`) VALUES ('$id_pid', '$mi_init_date', '$mi_disease', '$mi_room', '$mi_chief_complaint', '$mi_physician', '$mi_nurse', '$mi_init', '$mi_procedure', '$mi_medication')") or die(mysqli_error($con));
    if($insert) {
        //update script
        #$update = mysqli_query($con, "UPDATE `tb_id_medical_info` SET `miid`=[value-1],`id_pid`=[value-2],`mi_init_date`=[value-3],`mi_disease`=[value-4],`mi_room`=[value-5],`mi_chief_complaint`=[value-6],`mi_physician`=[value-7],`mi_nurse`=[value-8],`mi_init`=[value-9],`mi_procedures`=[value-10],`mi_medications`=[value-11] WHERE 1") or die(mysqli_error($con));
        echo $result ='<div class="alert alert-success text-dark" role="alert"><strong>Success! </strong>Patient '.$id_pid.' medication information is successfully registered</div>';
        die();
    } else {
        //throw error
    }
} elseif($type=='diary_update') {
    //diary
    $miid = $_POST['miid'];
    $id_pid = $_POST['id_pid'];
    $mi_init_date = $_POST['mi_init_date'];
    $mi_disease = $_POST['mi_disease'];
    $mi_room = $_POST['mi_room'];
    $mi_chief_complaint = $_POST['mi_chief_complaint'];
    $mi_physician = json_encode($_POST['mi_physician'], JSON_FORCE_OBJECT);
    $mi_nurse = json_encode($_POST['mi_nurse'], JSON_FORCE_OBJECT);
    $mi_init = $_POST['mi_init'];
    $mi_medication = $_POST['mi_medication'];
    $mi_procedure = $_POST['mi_procedure'];
    echo 'update';
    die();
    $insert = mysqli_query($con, "UPDATE `tb_id_medical_info` SET `mi_init_date`='$mi_init_date',`mi_room`='$mi_room',`mi_chief_complaint`='$mi_chief_complaint', `mi_physician`='$mi_physician',`mi_nurse`='$mi_nurse',`mi_init`='$mi_init',`mi_procedures`='$mi_procedure',`mi_medications`='$mi_medication' WHERE miid='$miid'") or die(mysqli_error($con));
    if($insert) {
        //update script
        #$update = mysqli_query($con, "UPDATE `tb_id_medical_info` SET `miid`=[value-1],`id_pid`=[value-2],`mi_init_date`=[value-3],`mi_disease`=[value-4],`mi_room`=[value-5],`mi_chief_complaint`=[value-6],`mi_physician`=[value-7],`mi_nurse`=[value-8],`mi_init`=[value-9],`mi_procedures`=[value-10],`mi_medications`=[value-11] WHERE 1") or die(mysqli_error($con));
        echo $result ='<div class="alert alert-success text-dark" role="alert"><strong>Success! </strong>Patient '.$id_pid.' medication information has been updated</div>';
        die();
    } else {
        //throw error
    }    
} elseif($type=='merger') {
    $pid =$_POST['pid'];
    $name =$_POST['name'];
    $mpid =$_POST['mpid'];
    $mname =$_POST['mname'];
    //do query
    //delete old
    $delete = mysqli_query($con, "DELETE FROM `tb_id_patients` WHERE id_pid='$pid'")or die(mysqli_error($con));
    //update pid assoc
    $update = mysqli_query($con,"UPDATE `tb_id_medical_info` SET id_pid=$mpid WHERE id_pid=$pid") or die(mysqli_error($con));
    echo $result = '<h4>Merging Patient</h4>';
    die(); 
} else {
    //do nothing
}
//address intellisense
/*$query = mysqli_query($con, "SELECT CONCAT($select) AS result FROM $table WHERE $select LIKE '%".$query."%' ORDER BY $select ASC") or die(mysqli_error($con));
$result = '<ul  class="list-group">';
while ($row =mysqli_fetch_assoc($query)) {
    $result .= '<li class="list-group-item '.$type.'">'.$row['result'].'</li>';
}
$result .= '</ul>';
echo $result;
die();*/
//address autocomplete()
$query = mysqli_query($con, "SELECT CONCAT($select) AS result FROM $table WHERE $select LIKE '%".$query."%' ORDER BY $select ASC LIMIT 3") or die(mysqli_error($con));
$response = array();
while ($row =mysqli_fetch_assoc($query)) {
    $response[] = array("value"=>$row['result']);
}
echo json_encode($response);
die();
?>
