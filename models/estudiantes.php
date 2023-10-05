<?php
    require_once('connect.php');
    
    $tu = $_GET['turno'];
    $an = $_GET['anio'];

    $db = new Database();
    $sql = "SELECT * FROM estudiantes WHERE tur_estudiante = $tu AND ano_estudiante = $an ORDER BY nom_estudiante";
    $est = $db->query($sql);
    $est->setFetchMode(PDO::FETCH_ASSOC);
    $result = $est->fetchall();

    echo json_encode($result);
?>