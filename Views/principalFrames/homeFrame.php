<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fincas</title>
  <link rel="stylesheet" href="homeCSS.css" />
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>MENU</h2>
      <nav>
        <a href="registerFinca.html">&#x2696; CREAR FINCA</a>
        <a href="#">&#x1F4C8; REPORTE</a>
        <a href="../../Controllers/logoutController.php">&#x1F6AA; SALIR</a>
      </nav>
    </aside>

    <main class="main">
      <div class="top-bar">
        <input type="text" placeholder="Buscar finca..." class="search-input"/>
      </div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>CODIGO</th>
              <th>NOMBRE</th>
              <th>HECTAREAS</th>
              <th>METROS</th>
              <th>PAIS</th>
              <th>DEPARTAMENTO</th>
              <th>CIUDAD</th>
              <th><span class="gear-icon">&#9881;</span></th>
            </tr>
          </thead>
          <tbody>
          <?php
            require_once __DIR__ . '/../../vendor/autoload.php';
            require_once __DIR__ . '/../../config/database.php';            

            use Illuminate\Database\Capsule\Manager as DB;

            try {
                $fincas = DB::table('fincas')->get();
            
                foreach ($fincas as $finca) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($finca->codigo_finca) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->nombre) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->numHectareas) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->metrosCuadrados) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->pais) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->departamento) . "</td>";
                    echo "<td>" . htmlspecialchars($finca->ciudad) . "</td>";
                    echo "<td><button>Editar</button> <button>Eliminar</button></td>";
                    echo "</tr>";
                }
            } catch (Exception $e) {
                echo "<tr><td colspan='8'>Error al obtener las fincas: " . $e->getMessage() . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="filters">
        <span>PROPIETARIO</span>
        <span>VENDEDOR</span>
        <span>CAPATAZ</span>
        <span>CIUDAD</span>
        <div class="input-group">
          <input type="text" placeholder="Filtrar..." />
          <button>&#128269;</button>
        </div>
      </div>
    </main>
  </div>
</body>
</html>