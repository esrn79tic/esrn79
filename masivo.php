<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes Cualitativos - Campura masiva de datos</title>
    <link rel="shortcut icon" href="pics/favicon.png">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="full p-centered"> <!-- Contenedor total -->
    <div class="zona-central"> <!-- Contenedor central -->
      <?php include_once "inc/header.php"; ?>
      <div class="container">
        <?php
          if (isset($_GET['import_status'])) {
            $alerta = $_GET['import_status'];
              switch ($alerta) {
                case 1:
                  $class = "success";
                  $alert = "Registro realizado con éxito.";
                  break;
                case 2:
                  $class = "warning";
                  $alert = "se presentaron errores en los datos.";
                  break;
                case 3:
                  $class = "warning";
                  $alert = "El archivo no pudo ser procesado.";
                  break;
                case 4:
                  $class = "error";
                  $alert = "Archivo csv no válido.";
                  break;
              }
        ?>
            <div class="columns">
              <div class="column col-4 col-ml-auto mt-2">
                <div class="toast toast-<?php echo $class; ?>">
                  <button class="btn btn-clear float-right"></button>
                  Resultado: <?php echo $alert; ?>
                </div>
              </div>
            </div>
        <?php    
          }
        ?>
        <div class="columns">
          <div class="column col-4 col-md-6 col-sm-8 col-xs-12 col-mx-auto">
            <div class="card">
              <form action="models/leer_csv.php" enctype="multipart/form-data" method="post" id="import_form">
                <div class="card-header">
                  <div class="card-title h5">Capturar datos</div>
                  <div class="card-subtitle text-gray">desde un archivo CSV</div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <!-- <label class="form-label" for="file">Archivo CSV</label> -->
                    <input class="form-input" type="file" name="file">
                    
                  </div>
                </div>
                <div class="card-footer mt-2">
                  <button type="submit" class="btn btn-primary" name="import_data" id="enviar">Cargar Datos</button>
                  <button type="reset" class="btn btn-secondary" id="clean" style="margin-left:20px">reiniciar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js" type="text/javascript" /></script>
  <script src="js/main.js" type="text/javascript" /></script>
</body>
</html>