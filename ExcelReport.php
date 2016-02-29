<?php

/**
 * Description of Generate_Queries
 *
 * @author daniel naval
 */
class ExcelReport {
   
   //Load the PHPExcel files
    public function Load_File($fichier) {
        
         // Creation de l'objet PHPExcel
        $objPHPExcel = new PHPExcel();

        // Cr�ation de l'objet Reader pour un fichier Excel 2007
        $objReader = new PHPExcel_Reader_Excel2007();

        // Permet de ne r�cup�rer que les valeurs des cellules sans les propri�t�s de style
        $objReader->setReadDataOnly(true);

        // Lecture du fichier.
        $objPHPExcel = $objReader->load($fichier);

        // Si on ignore le format du fichier, utiliser PHPExcel_IOFactory
        $objPHPExcel = PHPExcel_IOFactory::load($fichier); 
        
        return $objPHPExcel;
    }
    
	
	//Function to export data from Oracle with PDO
   public function OracleExportP($objPHPExcel, $result, $fichier) {
	     
        $result->execute();
        
        //Count field and display them 
        $num=2;
        //Load Information excel sheet from oracle database.
        while ($resultat=$result->fetch(PDO::FETCH_ASSOC)) {

		 $alpha = "A";
		//Add the name of the field
	   foreach($resultat as $cle=>$v) {
			 $field = strtoupper($cle);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.'1', $field);
		  $alpha++;
		}

			  $alpha = "A";
			foreach( $resultat as $val) {
				// Saisie de plusieurs cellules en une instruction
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$num, $val);
			  $alpha++;
			}
	
           $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
           $objWriter->save($fichier);
		   
		   $num++;
        }
   }
	
	//Function to export data from Oracle
   public function OracleExportS($objPHPExcel, $result, $fichier) {
	     
        oci_execute($result, OCI_DEFAULT);
        
        //Count field and display them 
        $col=oci_num_fields($result);

        $k=0;
        $d=1;

		//Add the name of the field
	   for( $alpha = "A"; $d <= $col; $alpha++ ) {
			 $n = $k+1;
			 $field = strtoupper(oci_field_name($result,$n));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.'1', $field);
		  $d++;
		  $k++;
		}
		
        $num=2;
        //Load Information excel sheet from oracle database.
        while ($resultat=oci_fetch_array($result, OCI_RETURN_NULLS)) {

			  $h=1;
			  $j =0;

			for( $alpha = "A"; $h <= $col; $alpha++ ) {
				// Saisie de plusieurs cellules en une instruction
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$num, $resultat[$j]);
					 
			  $h++;
			  $j++;
			}
	
			
           $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
           $objWriter->save($fichier);
		   
		   $num++;
        }
   }
   
   
   //Function to export data from Mysql
   public function MysqlExport($objPHPExcel, $result, $fichier) {
        
        //Count field and display them 
        $col=mysql_num_fields($result);

        $k=0;
        $d=1;

		//Add the name of the field
	   for( $alpha = "A"; $d <= $col; $alpha++ ) {
			 //$n = $k+1;
			 $field = strtoupper(mysql_field_name($result,$k));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.'1', $field);
		  $d++;
		  $k++;
		}
		
        $num=2;
        //Load Information excel sheet from oracle database.
        while ($resultat=mysql_fetch_array($result)) {

			  $h=1;
			  $j =0;

			for( $alpha = "A"; $h <= $col; $alpha++ ) {
				// Saisie de plusieurs cellules en une instruction
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$num, $resultat[$j]);
					 
			  $h++;
			  $j++;
			}
	
			
           $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
           $objWriter->save($fichier);
		   
		   $num++;
        }
   }
   
   //Function to export data from Sql Server
    public function SqlsrvExport($objPHPExcel, $result, $fichier,$conn) {
	
//echo $result.'<br/>';
		
		$stmt = sqlsrv_query($conn,$result);
		
		//echo $stmt.'<br/>';
				
		$alpha = "A";
		foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
		   $field = $fieldMetadata['Name']; 
		   //echo $field.'<br/>';
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.'1', $field);
            $alpha++;
		}

       
		$num=2;
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		
                    $alpha = "A";
				   foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
				        $n = $fieldMetadata['Name'];
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$num, $row[$n]);
						$alpha++;
					}    
					
			 $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
             $objWriter->save($fichier);
		   
		   $num++;

		}
		
   }
    
	//View data from oracle after export
    public function OCIS_Display($result) {
         //Execute query
        oci_execute($result, OCI_DEFAULT);
        
        //Count field and display them 
        $nombre=oci_num_fields($result);
        $i=0;
        echo "<table width=100% cellpading='2' cellspacing='2'>";

        echo "<tr bgcolor='999999'>";
        for ($i; $i<$nombre; $i++) {
            echo "<th style='border: 1px solid #999999'><font color='FFFFFF'>";
            echo  strtoupper(oci_field_name($result,$i+1));
            echo "</font></th>";
        }
        echo "</tr>";
        
        oci_execute($result, OCI_DEFAULT);
        //Display the information
        while ($data=oci_fetch_array($result, OCI_RETURN_NULLS)) {
            echo "<tr>";
            for ($j=0; $j<$nombre; $j++) {
              echo "<td align='center' style='border: 1px solid #999999'><font size='3'>$data[$j]</font></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }   
	
	//View data from oracle after export with PDO
	public function OCIP_Display($result) {
         //Execute query
         $result->execute();
        
        //Count field and display them 
       $columns=$result->fetch(PDO::FETCH_ASSOC);
        $i=0;
        echo "<table width=100% cellpading='2' cellspacing='2'>";

        echo "<tr bgcolor='999999'>";
        foreach($columns as $cle=>$v) {
            echo "<th style='border: 1px solid #999999'><font color='FFFFFF'>";
            echo  strtoupper($cle);
            echo "</font></th>";
        }
        echo "</tr>";
        
        //Display the information
        while($cols=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach($cols as $val) {
              echo "<td align='center' style='border: 1px solid #999999'><font size='3'>".$val."</font></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
         
	}
	
	////View data from mysql after export
	public function Mysql_Display($result) {
        mysql_data_seek($result, 0);
        //Count field and display them 
        $nombre=mysql_num_fields($result);
        $i=0;
        echo "<table cellpading='2' cellspacing='2'>";

        echo "<tr bgcolor='999999'>";
        for ($i; $i<$nombre; $i++) {
            echo "<th style='border: 1px solid #999999'><font color='FFFFFF'>";
            echo  strtoupper(mysql_field_name($result,$i));
            echo "</font></th>";
        }
        echo "</tr>";
        
        //Display the information
        while ($data=mysql_fetch_array($result)) {
		    //echo $data[0];
            echo "<tr>";
            for ($j=0; $j<$nombre; $j++) {
              echo "<td align='center' style='border: 1px solid #999999'><font size='3'>".$data[$j]."</font></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }   
	
    //View data from SQLServer after export
	public function SQLsrv_Display($conn,$result) {
	
		$stmt = sqlsrv_query( $conn, $result );
		
		echo '<table class="table1">';
        echo '<tr>';
		
		foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
			   echo "<th>".$fieldMetadata['Name']."</th>";
 
		}
		 echo "</tr>";

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				 echo '<tr>';
				   foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
				        $n = $fieldMetadata['Name'];
						echo '<td>'.$row[$n].'</td>';
					}    
				 echo '</tr>';
		}

		echo '</table>';
    }   
	
	
    public function Copy_File($fichier,$type) {
	    $date = date('d-m-y');
         if(file_exists($fichier))
		{ 
			 $newfic = "./reports/".$type.$date.'_Books.xlsx';
			 if (!copy($fichier, $newfic)) {
			   echo "La copie $fichier du fichier a &eacute;chou&eacute;...\n";
			 } 
		}
		return $newfic;
    }	
	
	public function Backup_File($fichier,$type) {
	    $date = date('d-m-y');
         if(file_exists($fichier))
		{ 			 
			 $bckfic = "./bck_reports/".$type.$date.'_Books.xlsx';
			 if (!copy($fichier, $bckfic)) {
			   echo "La copie $fichier du fichier a &eacute;chou&eacute;...\n";
			 } 
		}
    }	
    
}

?>
