<?php
// Conexion al base de datos
require_once('connect.php');
$db = new Database();
if(isset($_POST['import_data'])) {
    // validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)) {
        if(is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            //fgetcsv($csv_file);
            // get data records from csv file
            while(($record = fgetcsv($csv_file)) !== FALSE) {
                // Check if record already exists
                $rows = 0;
                $sql_query = "SELECT * FROM registros WHERE id_registro = ".$record[0];
                $query = $db->query($sql_query);
                $rows = $query->rowCount();
                // if already exist update otherwise insert new record
                if($rows > 0) {
                    $sql_update = "UPDATE registros SET 
                        asistencia=:asistencia, 
                        participacion=:participacion, 
                        trayectoria=:trayectoria, 
                        proceso=:proceso,
                        fortalecer=:fortalecer,
                        criterios=:criterios,
                        observaciones=:observaciones,
                        mostrar=:mostrar 
                        WHERE id_registro=:id";
                    $result = $db->prepare($sql_update)->execute(
                        array(
                            ':asistencia' => $record[3],
                            ':participacion' => $record[4],
                            ':trayectoria' => $record[5],
                            ':proceso' => $record[6],
                            ':fortalecer' => $record[7],
                            ':criterios' => $record[8],
                            ':observaciones' => $record[9],
                            ':mostrar' => $record[10],
                            ':id' => $record[0]
                        )
                    );
                    // echo "Informe " . $record[0] . " Actualizado.<br>";
                } else {
                    $sql_insert = "INSERT INTO registros 
                        (id_registro, id_estudiante, id_materia, asistencia, participacion, trayectoria, proceso, fortalecer, criterios, observaciones, mostrar) 
                    VALUES 
                        (:id, :estudiante, :materia, :asistencia, :participacion, :trayectoria, :proceso, :fortalecer, :criterios, :observaciones, :mostrar)";
                    $result = $db->prepare($sql_insert)
                    ->execute(
                        array(
                        ':id' => $record[0],
                        ':estudiante' => $record[1],
                        ':materia' => $record[2],
                        ':asistencia' => $record[3],
                        ':participacion' => $record[4],
                        ':trayectoria' => $record[5],
                        ':proceso' => $record[6],
                        ':fortalecer' => $record[7],
                        ':criterios' => $record[8],
                        ':observaciones' => $record[9],
                        ':mostrar' => $record[10],
                        )
                    );
                    // echo "Informe " . $record[0] . " registrado.<br>";
                }
            }
            fclose($csv_file);
            if($result) {
                $import_status = '?import_status=1'; // exito
            } else {
                $import_status = '?import_status=2'; // hubo un error al importar
            }
        } else {
            $import_status = '?import_status=3'; // no subio el archivo
        }
    } else {
        $import_status = '?import_status=4'; // archivo no valido
    }
}
header("Location: http://localhost/esrn79/masivo.php".$import_status);
?>