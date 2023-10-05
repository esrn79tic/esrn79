<?php
    /* CONFIG */
    $tu = $_POST['turno'];
    $an = $_POST['anio'];
    /* FIN CONFIG */

    // Conexion al base de datos
    require_once('con.php');
    $db1 = new Database();

    $sql1 = "SELECT * FROM estudiantes WHERE tur_estudiante = $tu AND ano_estudiante = $an ORDER BY nom_estudiante";
    $est = $db1->query($sql1);

    $titulo = 'INFORME CUALITATIVO - SEGUNDO CUATRIMESTRE 2023';

    require_once("tcpdf/tcpdf.php");


    // define ('PDF_FONT_NAME_MAIN', 'helvetica');
    // define ('PDF_FONT_SIZE_MAIN', 10);
    // define ('PDF_FONT_NAME_DATA', 'helvetica');
    // define ('PDF_FONT_SIZE_DATA', 8);
    // define ('PDF_FONT_MONOSPACED', 'courier');
    // define ('PDF_IMAGE_SCALE_RATIO', 1.25);
    // define ('HEAD_MAGNIFICATION', 1.1);
    // define ('K_CELL_HEIGHT_RATIO', 1.25);
    // define ('K_TITLE_MAGNIFICATION', 1.3);
    // define ('K_SMALL_RATIO', 2/3);
    define ('K_TCPDF_CALLS_IN_HTML', true);
    define ('K_TCPDF_THROW_EXCEPTION_ERROR', false);

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setFont('helvetica', '', 10, '', true);
    $pdf->setMargins(15, 15, 15, 15);
    $pdf->AddPage();
    // set cell padding
    $pdf->setCellPaddings(1, 1, 1, 1);
    // set cell margins
    $pdf->setCellMargins(1, 1, 1, 1);

    // Cabecera
    $pdf->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);