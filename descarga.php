<?php 
     if( ! ini_get('date.timezone') ) { date_default_timezone_set('America/Santiago'); } 

     require ("../../main_app/coor/zipfile.php");
     require('../../pdf/fpdf/fpdf.php');
     require('../conexion.php');
     $mysqli->set_charset("utf8");
     $mysqli->query("SET NAMES 'utf8'");
     $mysqli->query("SET CHARACTER SET utf8");   
    $data = Array();
    $data = json_decode($_POST['json']); //print_r($data); //echo count($data); 
    $user = $mysqli->real_escape_string($_POST['user']); //echo "$user";
    $vl = $mysqli->real_escape_string(md5($_POST['vl'])); //echo "$vl";
    $now = date('d-m-Y'); 

    foreach ($data as $v) { $i++;
      
    $consulta = $mysqli->query("SELECT * FROM cr_comentario WHERE cr_id_com = '$data[i]$v'");
    while($row = mysqli_fetch_array($consulta)){
        $ta = $row['cr_id_tareas']; //echo($ta);
        $fa = $row['cr_f_asig']; //echo $fa;
        $id = $row['cr_id_com']; //echo $id;
      
     
      //-------------------------------------------------------------------------------------------------------------------------//

    global $mysqli;
    global $id;
    global $ta;
    global $fa;
        
         class PDF extends FPDF
         {
             
         // Cabecera de página
         function vcell($c_width,$c_height,$x_axis,$text){ 
         $w_w=$c_height/8; 
         $w_w_1=$w_w+1; 
         $w_w1=$w_w_1+$w_w+1; 
         $w_w2=$w_w+$w_w1+1; $w_w3=$w_w+$w_w2+1; $w_w4=$w_w+$w_w3+1; $w_w5=$w_w+$w_w4+1; $w_w6=$w_w+$w_w5+1; $w_w7=$w_w+$w_w6+1; $w_w8=$w_w+$w_w7+1; 
         $len=strlen($text); //echo $len;// check the length of the cell and splits the text into 7 character each and saves in a array 
         $text1 = ucwords(strtolower($text)); 
         if($len>=48){ 
         $w_text=str_split($text1,48); //print_r($w_text);
         
         $this->SetX($x_axis); 
         $this->Cell($c_width,$w_w_1,$w_text[0],'','C','0'); 
         $this->SetX($x_axis); 
         $this->Cell($c_width,$w_w1,$w_text[1],'','C','0'); 
         $this->SetX($x_axis);
         $this->Cell($c_width,$w_w2,$w_text[2],'','C','0'); 
         $this->SetX($x_axis); 
         $this->Cell($c_width,$w_w3,$w_text[3],'','C','0'); 
         $this->SetX($x_axis);
         $this->Cell($c_width,$w_w4,$w_text[4],'','C','0'); 
         $this->SetX($x_axis); 
         $this->Cell($c_width,$w_w5,$w_text[5],'','C','0'); 
         $this->SetX($x_axis);
         $this->Cell($c_width,$w_w6,$w_text[6],'','C','0'); 
         $this->SetX($x_axis); 
         $this->Cell($c_width,$w_w7,$w_text[7],'','C','0'); 
         $this->SetX($x_axis);    
         $this->Cell($c_width,$c_height,'','LTRB',1,'C',0); 
         }else{ 
             $this->SetX($x_axis); 
             $this->Cell($c_width,45,$text,'1',1,'C',0);} 
             } 

         function Header()
         {
             $this->SetFont('Times','B',8);
             $this->Cell(40,5,' ','LTR',0,'L',0); // empty cell with left,top, and right borders
             $this->SetFont('Times','B',12);
             $this->Cell(110,7,utf8_decode('BITÁCORA DIARIA DE TRABAJOS EN TERRENO'),'1',0,'C',0); // empty cell with left,top, and right borders 
             $this->SetFont('Times','',8);
             //$this->Cell(50,5,'111 Here',1,0,'L',0); 
             $this->Cell(45,5,utf8_decode('CÓDIGO / CODE:'),1,0,'L',0); 
             $this->Ln();
             $this->Cell(40,5,$this->Image('../../img/logo_p.png', 10, 10, 35, 15,'PNG'),'LR',0,'C',0); // cell with left and right borders
             $this->SetFont('Times','B',10);
             $this->Cell(110,10,utf8_decode('ÁREA GERENCIA PROYECTOS'),'LR',0,'C',0);
             $this->SetFont('Times','',8);
             $this->Cell(45,5,'FECHA / DATE:','1',0,'L',0); 
             $this->Ln(); 
             $this->Cell(40,5,'','LBR',0,'L',0); // empty cell with left,bottom, and right borders
             $this->Cell(110,5,'  ','LRB',0,'L',0); 
             $this->Cell(45,5,utf8_decode('VERSIÓN / VERSION:'),'LRB',0,'L',0); 
         
             $this->Ln();
         
             global $title;
             global $text;
             global $mysqli;
             global $id;
             $cons = $mysqli->query("SELECT DISTINCT c.cr_id_com, c.cr_descripcion, c.cr_contacto, c.cr_lugar, ct.cr_f_ini, c.cr_hora_reg, c.cr_f_asig, c.cr_horas_perd, c.cr_avance, c.cr_f_reg, u.cr_nombre AS USER, ch.cr_hora_acu, ct.cr_id_proy, u.cr_img, p.cr_num_p FROM cr_comentario c LEFT JOIN cr_control_hora ch ON ch.cr_id_tareas = c.cr_id_tareas INNER JOIN cr_usuario u, cr_tareas ct, cr_proyecto p WHERE c.cr_id_usuario = u.cr_id_usuario AND c.cr_id_com = '$id' AND c.cr_id_tareas = ct.cr_id_tareas AND ct.cr_id_proy = p.cr_id_proy"); 
             while ($rw = mysqli_fetch_array($cons))
         {
             $id_com = $mysqli->real_escape_string($rw['cr_id_com']); //echo $id_com; //2555
             $desc = $mysqli->real_escape_string($rw['cr_descripcion']); //echo $desc; //(1)
             $hora_reg = $mysqli->real_escape_string($rw['cr_hora_reg']); //echo $hora_reg; //8
             $f_asig = $mysqli->real_escape_string($rw['cr_f_asig']); //echo $f_asig; //2021-08-16
             $hora_perd = $mysqli->real_escape_string($rw['cr_horas_perd']); //echo $hora_perd; //4
             $avanc = $mysqli->real_escape_string($rw['cr_avance']); //echo $avanc; //25
             $user = $mysqli->real_escape_string($rw['user']); //echo $user; //Nohelia
             $hora_acu = $mysqli->real_escape_string($rw['cr_hora_acu']); //echo $hora_acu; //25
             $id_proy = $mysqli->real_escape_string($rw['cr_id_proy']); //echo $id_proy; //57
             $contac = $mysqli->real_escape_string($rw['cr_contacto']); //echo $contac; //Nohelia Guzmán porras
             $lugar = $mysqli->real_escape_string($rw['cr_lugar']); //echo $lugar; //SE Agua santa
             $num_p = $mysqli->real_escape_string($rw['cr_num_p']); //echo $num_p; //131SC-SI-20-AGR
         
             $this->SetFont('Times','B',8);
             $w = $this->GetStringWidth($title)+6;
             $this->SetX((26-$w)/2);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(195,8,utf8_decode('INFORMACIÓN DE CLIENTE'),1,0,'C',true);
             $this->Ln();

             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(35,8,utf8_decode('PROYECTO INGEMA N°:'),1,0,'J',true); 
             $this->SetFont('Times','',8);
             $this->SetTextColor(0,0,0);
             $this->Cell(60,8,'' .$num_p,1,0,'C'); 
             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(35,8,utf8_decode('FECHA BITÁCORA:'),1,0,'J',true); 
             $this->SetFont('Times','',8);
             $this->SetTextColor(0,0,0);
             $this->Cell(65,8,'' .$f_asig,1,0,'C');
             $this->Ln();
             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(35,8,'CONTACTO:',1,0,'J',true); 
             $this->SetFont('Times','',8);
             $this->SetTextColor(0,0,0);
             $this->Cell(60,8,utf8_decode('' .$contac),1,0,'C'); 
             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(35,8,'LUGAR:',1,0,'J',true);  
             $this->SetFont('Times','',8);
             $this->SetTextColor(0,0,0);
             $this->Cell(65,8,utf8_decode('' .$lugar),1,0,'C');
             $this->Ln();
             

             $this->SetFont('Times','B',8);
             $w = $this->GetStringWidth($title)+6;
             $this->SetX((26-$w)/2);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(195,8,utf8_decode('ACTIVIDADES REALIZADAS'),1,0,'C',true);
             $this->Ln();

             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(60,8,utf8_decode('DESCRIPCIÓN BREVE DE ACTIVIDAD:'),1,0,'C',true); 
             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(60,8,'OBSERVACIONES:',1,0,'C',true);  
             $this->SetFont('Times','',8);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(25,8,'FECHA INICIO:',1,0,'C',true);  
             $this->SetFont('Times','',7);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->cell(25,8,'HORAS EFECTIVAS',1,0,'C',true); 
             $this->SetFont('Times','',7);
             $this->SetFillColor(60,166,0);
             $this->SetTextColor(255,255,255);
             $this->Cell(25,8,'HORAS PERDIDAS:',1,0,'C',true);  
             $this->Ln();
             
             //$this->SetY(230);
             //$this->Ln();
         }//fin sql
         }	// fin headers

         // Pie de página
         function Footer()
         {
             // Posición: a 1,5 cm del final
             $this->SetY(-15);
             // Arial italic 8
             $this->SetFont('Times','I',8);
             // Número de página
             $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
         }


         } // fin class pdf


         //// Creación del objeto de la clase heredada

         $pdf = new PDF();
         $pdf->AliasNbPages();
         $pdf->SetTitle(utf8_decode('BITÁCORA DIARIA'));
         $pdf->AddPage('P', 'Letter');
         //$pdf->Ln();

         $pdf->setFont('Times', '', 7);
          
         ////CONSULTA
         $reg = $mysqli->query("SELECT DISTINCT c.cr_id_com, c.cr_descripcion, ct.cr_descripcion AS tarea, c.cr_contacto, ct.cr_f_ini, c.cr_lugar, c.cr_hora_reg, c.cr_f_asig, c.cr_horas_perd, c.cr_avance, c.cr_f_reg, u.cr_nombre AS user, u.cr_cargo, u.cr_img, ch.cr_hora_acu, ct.cr_id_proy, u.cr_img, p.cr_num_p FROM cr_comentario c LEFT JOIN cr_control_hora ch ON ch.cr_id_tareas = c.cr_id_tareas INNER JOIN cr_usuario u, cr_tareas ct, cr_proyecto p WHERE c.cr_id_usuario = u.cr_id_usuario AND ct.cr_id_tareas = '$ta' AND c.cr_id_tareas = ct.cr_id_tareas AND ct.cr_id_proy = p.cr_id_proy AND c.cr_f_asig = '$fa'");
             while ($rw = mysqli_fetch_array($reg))
         {
             $id_com = $mysqli->real_escape_string($rw['cr_id_com']); //echo $id_com; //2555
             $desc = $mysqli->real_escape_string($rw['cr_descripcion']); //echo $desc; //(1)
             $hora_reg = $mysqli->real_escape_string($rw['cr_hora_reg']); //echo $hora_reg; //8
             $f_asig = $mysqli->real_escape_string($rw['cr_f_asig']); //echo $f_asig; //2021-08-16
             $hora_perd = $mysqli->real_escape_string($rw['cr_horas_perd']); //echo $hora_perd; //4
             $tarea = $mysqli->real_escape_string($rw['tarea']); //echo $tarea; //PRUEBA
             $f_ini = $mysqli->real_escape_string($rw['cr_f_ini']); //echo $f_ini; //2020-11-30
             
             $pdf->setFont('Times', '', 7);
             $x_axis=10; 
             
             $y1 = $pdf->GetY();
             $pdf->vcell(60,45,$x_axis,utf8_decode($tarea),1,0,'C'); //print one cell value
             $pdf->SetXY(60,$y1); 
             $x_axis=$pdf->GetX()+10;
             $pdf->vcell(60,45,$x_axis,utf8_decode($desc),1,0,'C'); 
              //echo "$y1"; 
             $pdf->SetXY(130,$y1); 
 
             $pdf->Cell(25,45,$f_ini,1,0,'C'); //printing next cell
             $pdf->Cell(25,45,$hora_reg,RB,0,'C');
             $pdf->Cell(25,45,$hora_perd,RB,0,'C');
             $pdf->Ln();
         }
         $reg = $mysqli->query("SELECT DISTINCT SUM(c.cr_hora_reg) AS hora_reg, SUM(c.cr_horas_perd) AS hora_perd FROM cr_comentario c LEFT JOIN cr_control_hora ch ON ch.cr_id_tareas = c.cr_id_tareas INNER JOIN cr_usuario u, cr_tareas ct, cr_proyecto p WHERE c.cr_id_usuario = u.cr_id_usuario AND ct.cr_id_tareas = '$ta' AND c.cr_id_tareas = ct.cr_id_tareas AND ct.cr_id_proy = p.cr_id_proy AND c.cr_f_asig = '$fa'");
         while ($rw = mysqli_fetch_array($reg))
     {
         $hora_reg = $mysqli->real_escape_string($rw['hora_reg']); //echo $hora_reg; //8
         $hora_perd = $mysqli->real_escape_string($rw['hora_perd']); //echo $hora_perd; //4
         

             $pdf->SetFont('Times','',8);
             $pdf->SetFillColor(60,166,0);
             $pdf->SetTextColor(255,255,255); 
             $pdf->Cell(145,5,'TOTAL HORAS:',1,0,'R',true);
             $pdf->SetTextColor(0,0,0); 
             $pdf->Cell(25,5,$hora_reg,1,0,'C');
             $pdf->Cell(25,5,$hora_perd,1,0,'C');
     }
             $pdf->Ln();
             $fir = $mysqli->query("SELECT DISTINCT c.cr_id_com, c.cr_descripcion, ct.cr_descripcion AS tarea, c.cr_contacto, ct.cr_f_ini, c.cr_lugar, c.cr_hora_reg, c.cr_f_asig, c.cr_horas_perd, c.cr_avance, c.cr_f_reg, u.cr_nombre AS user, u.cr_cargo, u.cr_img, ch.cr_hora_acu, ct.cr_id_proy, u.cr_img, p.cr_num_p FROM cr_comentario c LEFT JOIN cr_control_hora ch ON ch.cr_id_tareas = c.cr_id_tareas INNER JOIN cr_usuario u, cr_tareas ct, cr_proyecto p WHERE c.cr_id_usuario = u.cr_id_usuario AND c.cr_id_com = '$id' AND c.cr_id_tareas = ct.cr_id_tareas AND ct.cr_id_proy = p.cr_id_proy");
             while ($rw = mysqli_fetch_array($fir))
         {
             $id_com = $mysqli->real_escape_string($rw['cr_id_com']); //echo $id_com; //2555
             $user = $mysqli->real_escape_string($rw['user']); //echo $user; //Nohelia
             $cargo = $mysqli->real_escape_string($rw['cr_cargo']); //echo $f_ini; //2020-11-30
             $ruta = $mysqli->real_escape_string($rw['cr_img']); //echo $ruta; //2020-11-30

             
             $pdf->SetFont('Times','',8);
             $pdf->SetFillColor(60,166,0);
             $pdf->Cell(195,5,'',1,0,C,true);
             $pdf->Ln();
             $fill=false;
             $pdf->SetFillColor(60,166,0);
             $pdf->SetTextColor(255,255,255); 
             $pdf->Cell(72.5,5,'ELABORADO POR:',1,0,'C',true);
             $pdf->Cell(72.5,5,'CLIENTE:',1,0,'C',true);
             $pdf->Cell(50,5,'',R,0,'C');
             $pdf->Ln();

             $pdf->Cell(25,5,'NOMBRE:',1,0,'C',true);
             $pdf->SetTextColor(0,0,0); 
             $pdf->Cell(47.5,5,utf8_decode($user),1,0,'C');
             $pdf->SetTextColor(255,255,255); 
             $pdf->Cell(25,5,'NOMBRE:',1,0,'C',true);
             $pdf->Cell(47.5,5,'',1,0,'C');
             $pdf->Cell(50,5,'',R,0,'C');
             $pdf->Ln();
             
             $pdf->Cell(25,5,'CARGO:',1,0,'C',true);
             $pdf->SetTextColor(0,0,0); 
             $pdf->Cell(47.5,5,utf8_decode($cargo),1,0,'C');
             $pdf->SetTextColor(255,255,255); 
             $pdf->Cell(25,5,'CARGO:',1,0,'C',true);
             $pdf->Cell(47.5,5,'',1,0,'C');
             $pdf->Cell(50,5,'',R,0,'C');
             $pdf->Ln();

             $pdf->Cell(25,5,'FECHA:',1,0,'C',true);
             $pdf->SetTextColor(0,0,0); 
             $pdf->Cell(47.5,5,$now,1,0,'C');
             $pdf->SetTextColor(255,255,255); 
             $pdf->Cell(25,5,'FECHA:',1,0,'C',true);				
             $pdf->Cell(47.5,5,'',1,0,'C');
             $pdf->Cell(50,5,'',R,0,'C');
             $pdf->Ln();

             $pdf->Cell(25,40,'FIRMA:',1,0,'C',true);
             if(empty($ruta)){
                $pdf->Cell(47.5,40,'SIN FIRMA',1,0,'C'); 	 
            }else{
                $pdf->Cell(47.5,40, $pdf->Image("../../img/uploads/".$rw['cr_img'], $pdf->GetX(), $pdf->GetY(),47.5,40),1); 
            }			
             $pdf->Cell(25,40,'FIRMA:',1,0,'C',true);
             $pdf->Cell(47.5,40,'',1,0,'C');
             $pdf->Cell(50,40,'',RB,0,'C');
             $pdf->SetTextColor(0,0,0); 
             $pdf->Ln();
         }
        
       
    } //$pdf->Output('BITACORA.pdf', 'D');
    $pdf->Output('F', "../../pdf/temp/BITACORA.pdf");
    
}  

?>