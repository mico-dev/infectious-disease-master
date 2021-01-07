<?php
#$type = $_POST['type'];

#if($type == 'auto') {
    $mysqlUserName      = "root";
    $mysqlPassword      = "2125";
    $mysqlHostName      = "localhost";
    $DbName             = "db_mihmcinew";
    $backup_name        = "mybackup.sql";
    $tables             = "Your tables";
   //or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables

    Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tables=false, $backup_name=false );

    function Export_Database($host,$user,$pass,$name,  $tables=false, $backup_name=false ){
        $mysqli = new mysqli($host,$user,$pass,$name); 
        $mysqli->select_db($name); 
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables    = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row()){ 
            $target_tables[] = $row[0]; 
        }   
        if($tables !== false){ 
            $target_tables = array_intersect( $target_tables, $tables); 
        }
        foreach($target_tables as $table){
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $content .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }      
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $content .= ";";
                    } 
                    else 
                    {
                        $content .= ",";
                    } 
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        
        $queryTable    = $mysqli->query("SHOW TABLES LIKE '%tb_rtpcrfull%'");
        while($row = $queryTable->fetch_row()){
            $result         =   $mysqli->query('SELECT * FROM tb_rtpcrfull');  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE tb_rtpcrfull'); 
            $TableMLine     =   $res->fetch_row();
            $rtpcrfull        = (!isset($rtpcrfull) ?  '' : $rtpcrfull) . "\n\n".$TableMLine[1].";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $rtpcrfull .= "\nINSERT INTO tb_rtpcrfull VALUES";
                    }
                    $rtpcrfull .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $rtpcrfull .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $rtpcrfull .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $rtpcrfull.= ',';
                        }      
                    }
                    $rtpcrfull .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $rtpcrfull .= ";";
                    } 
                    else 
                    {
                        $rtpcrfull .= ",";
                    } 
                    $st_counter=$st_counter+1;
                }
            } $rtpcrfull .="\n\n\n"; 
        }   
        
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        date_default_timezone_set('Asia/Manila');
        $now = new DateTime();
        $now = $now->format('Y-m-d H-i-s-A');
        $backup_name = $backup_name ? $backup_name : $name."-".$now.".sql";
        $table_name = "tb_rtpcrfull-".$now.".sql";
        $dir='sql/db/';
        $table_dir='sql/table/';
            if (!is_dir($dir) or !is_writable($dir)) {
                // Error if directory doesn't exist or isn't writable.
                //exit($dir." is unwritable");
                //init setup dir
                echo 0;
                exit();
            } elseif (!empty($backup_name)) {

                // Error if the file exists and isn't writable.
                if(file_put_contents($dir.$backup_name, $content)){
                    if(file_put_contents($table_dir.$table_name, $rtpcrfull)){
                        echo 1;
                        exit();
                    }else{
                        echo 0;
                        exit();
                    }
                }else{
                    echo 1;
                    exit();
                }
            }
        /*header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-disposition: attachment; filename=\"".basename($backup_name)."\"");
        header("Content-Transfer-Encoding: binary ");    
        #header('Content-Type: application/octet-stream');   
        #header("Content-Transfer-Encoding: Binary"); 
        #header("Content-disposition: attachment; filename=\"".basename($backup_name)."\"");
        header("Connection: close");
        readfile($content); */
        exit();
    }
#}
    
?>