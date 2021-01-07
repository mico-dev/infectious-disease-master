<?php
session_start();
include 'config.php';
$day = date('d');
$month = date('m');

$filename = $day."-".$month;          
   
//execute query 
 $select = mysqli_query($con, "SELECT * FROM `tb_id_patients`") or die(mysqli_query($con));

// WHERE dateall >= '2018-09-11' AND dateall >= '2018-09-25'
 
    
$file_ending = "dbp";
//header info for browser
header("Content-Type: application/txt");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
 
#echo "$staff_un\t". "$fname\t"."$lname\t\n";
echo "SpecimenId\t";
echo "LastName\t";
echo "FirstName\t";
echo "MiddleName\t";
echo "BirthDate\t";
echo "Sex\t";
echo "PatientProvince\t";
echo "PatientCityMunicipality\t";
echo "PatientBarangay\t";
echo "SpecimenHealthFacility\t";
echo "DateOnsetIllness\t";
echo "DateSpecimenCollection\t";
echo "DateSpecimenReceive\t";
echo "DateResultReleased\t";
echo "SpecimenType\t";
echo "SpecimenNumber\t";
echo "Result\t";
echo "Remarks\t";
echo "PatientStreetHouseNumber\t";
echo "PatientContactNumber\t";
 
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_assoc($select))
    {
        echo $pid = $row['id_pid'];
        echo "\t";
        echo $firstname = $row['id_firstname'];
        echo "\t";
        echo $middlename = $row['id_middlename'];
        echo "\t";
        echo $lastname = $row['id_lastname'];
         /* 
        $actn = $row['p_actn'];
        $name = $row['p_name'];
        $npay = $row['p_netpay'];
          
        
         
        echo "123";
        echo "abc";
        echo "\t";
        echo " 99999\n";
        echo "123alkjnhhbngoui";
        echo "abc";
        echo "\t";
        echo " 99999\n";
        */
        
        $schema_insert = "\t";
        for($j=0; $j<mysqli_num_fields($select);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\n";
        print(trim($schema_insert));
        print "\n  ";
        
    }
?>