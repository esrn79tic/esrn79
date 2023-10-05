<?php
/* CONFIG */
$tu = $_GET['turno'];
$an = $_GET['anio'];
$es = "";
$nom_estudiante = "";
if((isset($_GET['estudiante'])) && (($_GET['estudiante']>0))) {
    $id_est = $_GET['estudiante'];
    $es = "AND id_estudiante = " . $id_est;
}
/* FIN CONFIG */

// Conexion al base de datos
require_once('models/connect.php');
$db1 = new Database();

$sql1 = "SELECT * FROM estudiantes WHERE tur_estudiante = $tu AND ano_estudiante = $an $es ORDER BY nom_estudiante";
$est = $db1->query($sql1);
$titulo = 'INFORME CUALITATIVO - SEGUNDO CUATRIMESTRE 2023';

require_once('fpdf/fpdf.php');
$pdf = new FPDF('L','mm','A4');
$pdf->SetAutoPageBreak(0);

foreach ($est as $item1) {
    // datos del estudiante
    $id = $item1['id_estudiante'];
    $turno = ($item1['tur_estudiante'] == 1) ? utf8_decode("MAÑANA") : "TARDE";
    $t = ($item1['tur_estudiante'] == 1) ? "TM" : "TT";
    $anio = $item1['ano_estudiante'] . utf8_decode(" Año");
    $nombre = utf8_decode($item1['nom_estudiante']);
    if($id_est>0) $nom_estudiante = $nombre . " ";
    // echo $id;
    
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(121,6,'ESRN 79 - SAN JAVIER',0,0,'L');
    $pdf->Cell(155,6,$titulo,1,1,'C');
    $pdf->ln(1);
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(27,5,'Estudiante:',0,0,'R');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(94,5,$nombre,0,0,'L');
    $pdf->Cell(60,5);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(55,5,'Turno:',0,0,'R');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,5,$turno,0,1,'L');
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(27,5,"Agrupamiento:",0,0,'L');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(94,5,$anio.' '.$t,0,0,'L');
    $pdf->Cell(60,5);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(55,5,'Preceptor:',0,0,'R');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,5,'','B',1,'L');
    $pdf->ln(2);

    // echo "1";
    
    $pdf->SetFont('Arial','',9.5);
    $pdf->Cell(25,5,utf8_decode("Área"),1,0,'C');
    $pdf->Cell(34,5,"Resumen",1,0,'C');
    $pdf->Cell(58,5,utf8_decode("Saberes en proceso de construcción"),1,0,'C');
    $pdf->Cell(57,5,"Saberes a fortalecer",1,0,'C');
    $pdf->Cell(70,5,utf8_decode("Criterios e indicadores de Evaluación"),1,0,'C');
    $pdf->Cell(32,5,"Observaciones",1,1,'C');
    $pdf->ln(2);

    // echo "2";

    $db2 = new Database();
        $sql2 = "SELECT r.*, e.*, m.* FROM registros r 
            LEFT JOIN estudiantes e ON r.id_estudiante = e.id_estudiante
            LEFT JOIN materias m ON r.id_materia = m.id_materia
            WHERE r.id_estudiante = $id AND r.mostrar = 1 ORDER BY r.id_materia";
        $inf = $db2->query($sql2);
        // echo($inf->fetchColumn());
        $h = 40;
        $y = $pdf->gety();
        $x = $pdf->getx();
        $pdf->SetFont('Arial','',9.5);
        $mat = 0;

        // echo "3";
        
        foreach ($inf as $item) {
            $mat++;
            $materia = utf8_decode($item['nom_materia']);
            $asiste = utf8_decode($item['asistencia']);
            $participa = utf8_decode($item['participacion']);
            $trayecto = utf8_decode(strtoupper($item['trayectoria']));
            $proceso = utf8_decode($item['proceso']);
            $fortalece = utf8_decode($item['fortalecer']);
            $criterios = utf8_decode($item['criterios']);
            $observa = utf8_decode($item['observaciones']);
            // echo $mat;

            // echo "4";
            // TABLA
            $x = $pdf->getx();
            $pdf->setxy($x, $y);
            $pdf->MultiCell(25,4,$materia,0,'C',0);
            $x += 25;
            // Resumen
            $pdf->setxy($x,$y+1);
            $pdf->cell(34,1,"Asistencia:",0,0,'C');
            $pdf->SetFont('','B');
            $pdf->setxy($x,$y+4);
            $pdf->cell(34,1,$asiste . "%",0,0,'C');
            $pdf->SetFont('','');
            $pdf->setxy($x,$y+8);
            $pdf->cell(34,1,"----------------------",0,0,'C');
            $pdf->setxy($x,$y+12);
            $pdf->cell(34,1,utf8_decode("Participación:"),0,0,'C');
            $pdf->setxy($x,$y+16);
            $pdf->SetFont('','B');
            $pdf->cell(34,1,$participa . " participa",0,0,'C');
            $pdf->SetFont('','');
            $pdf->setxy($x,$y+20);
            $pdf->cell(34,1,"----------------------",0,0,'C');
            $pdf->setxy($x,$y+24);
            $pdf->cell(34,1,"Estado de la",0,0,'C');
            $pdf->setxy($x,$y+28);
            $pdf->cell(34,1,"Trayectoria",0,0,'C');
            $pdf->setxy($x,$y+32);
            $pdf->SetFont('','B');
            $pdf->cell(34,1,$trayecto,0,0,'C');
            $pdf->SetFont('','');
            // fin Resumen
            $x += 34;
            $pdf->setxy($x, $y);
            $pdf->MultiCell(58,4,$proceso,0,'L',0);
            $x += 58;
            $pdf->setxy($x, $y);
            $pdf->MultiCell(58,4,$fortalece,0,'L',0);
            $x += 58;
            $pdf->setxy($x, $y);
            $pdf->MultiCell(69,4,$criterios,0,'L',0);
            $x += 69;
            $pdf->setxy($x, $y);
            $pdf->MultiCell(34,4,$observa,0,'L',0);
            $x = $pdf->getx()+2;
            $y += $h;
            $pdf->line(10,$y-2,286,$y-2);

            if(($y > 170)&&($mat < 8)){
                // Repetir encabezados
	            $pdf->AddPage();
                $pdf->SetFont('Arial','',9.5);
                $pdf->Cell(25,5,utf8_decode("Área"),1,0,'C');
                $pdf->Cell(34,5,"Resumen",1,0,'C');
                $pdf->Cell(58,5,utf8_decode("Saberes en proceso de construcción"),1,0,'C');
                $pdf->Cell(57,5,"Saberes a fortalecer",1,0,'C');
                $pdf->Cell(70,5,utf8_decode("Criterios e indicadores de Evaluación"),1,0,'C');
                $pdf->Cell(32,5,"Observaciones",1,1,'C');
                $pdf->ln(2);
                $y = 17;
                // $pdf->line(10,$y-2,286,$y-2);
            }
        }
    }
    $nfile = $nom_estudiante . $anio . ' ' . $t;
    $archivo = $nfile . ".pdf";
    $pdf->Output($archivo,'I');
    // $pdf->Output();

