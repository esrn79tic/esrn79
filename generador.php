<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes Cualitativos - Generar Informes</title>
    <link rel="shortcut icon" href="pics/favicon.png">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="full p-centered"> <!-- Contenedor total -->
    <div class="zona-central"> <!-- Contenedor central -->
      <?php include_once "inc/header.php"; ?>
      <div class="container">
        <div class="columns">
          <div class="column col-4 col-md-6 col-sm-8 col-xs-12 col-mx-auto">
            <div class="card">
              <form action="informes.php" target="_blank" method="get">
                <div class="card-header">
                  <div class="card-title h5">Generar Informes</div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label class="form-label" for="turno">Turno</label>
                      <!-- <div class="form-group"> -->
                        <select class="form-select" id="turno" name="turno" required>
                          <option value="" hidden>Seleccione el turno...</option>
                          <option value="1">Mañana</option>
                          <option value="2">Tarde</option>                          
                        </select>
                      <!-- </div> -->
                    <label class="form-label" for="anio">Año</label>
                      <!-- <div class="form-group"> -->
                        <select class="form-select" id="anio" name="anio" required>
                          <option value="" hidden>Seleccione el año...</option>
                          <option value="1">1er año</option>
                          <option value="2">2do año</option>
                          <option value="3">3er año</option>
                          <option value="4">4to año</option>
                          <option value="5">5to año</option>
                        </select>
                      <!-- </div> -->
                    <label class="form-label" for="estudiante">Estudiante</label>
                      <!-- <div class="form-group"> -->
                        <select class="form-select" id="estudiante" name="estudiante">
                          <option value="0" selected>Todo el grupo</option>
                        </select>
                      <!-- </div> -->
                  </div>
                </div>
                <div class="card-footer mt-2">
                  <button type="submit" class="btn btn-primary" id="enviar">Generar</button>
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