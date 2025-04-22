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
        <a href="registerFinca.html">&#x2696; Crear Finca</a>
        <a href="../../Views/principalFrames/reportFinca.html">📄 Reporte</a>
        <a href="../../Controllers/logoutController.php">&#x1F6AA; Salir</a>
      </nav>
    </aside>

    <main class="main">
      <div class="top-bar">
        <form action="../../Controllers/searchFincaController.php" method="POST" class="search-form">
          <input type="text" placeholder="Buscar finca..." class="search-input" name="search_input"/>
          <button type="submit" class="search-button">&#128269;</button>
        </form>
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
              $fincas = DB::table('fincas')
                  ->leftJoin('usuarios as propietario', 'fincas.propietario_id', '=', 'propietario.id_usuario')
                  ->leftJoin('usuarios as capataz', 'fincas.capataz_id', '=', 'capataz.id_usuario')
                  ->leftJoin('usuarios as vendedor', 'fincas.vendedor_id', '=', 'vendedor.id_usuario')
                  ->select(
                      'fincas.*',
                      'propietario.codigo_usuario as codigo_propietario',
                      'capataz.codigo_usuario as codigo_capataz',
                      'vendedor.codigo_usuario as codigo_vendedor'
                  )
                  ->get();
          
              foreach ($fincas as $finca) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($finca->codigo_finca) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->nombre) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->numHectareas) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->metrosCuadrados) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->pais) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->departamento) . "</td>";
                  echo "<td>" . htmlspecialchars($finca->ciudad) . "</td>";
                  echo "<td>
                  <button type='button' class='edit-btn' 
                      data-codigo='" . htmlspecialchars($finca->codigo_finca) . "' 
                      data-nombre='" . htmlspecialchars($finca->nombre) . "' 
                      data-propietario='" . htmlspecialchars($finca->codigo_propietario) . "' 
                      data-capataz='" . htmlspecialchars($finca->codigo_capataz) . "' 
                      data-vendedor='" . htmlspecialchars($finca->codigo_vendedor) . "' 
                      data-leche='" . htmlspecialchars($finca->siProduceLeche) . "' 
                      data-cereales='" . htmlspecialchars($finca->siProduceCereales) . "' 
                      data-frutas='" . htmlspecialchars($finca->siProduceFrutas) . "' 
                      data-verduras='" . htmlspecialchars($finca->siProduceVerduras) . "'>
                  Editar
                  </button>
                  <button type='button' class='view-btn' 
                      data-codigo='" . htmlspecialchars($finca->codigo_finca) . "' 
                      data-nombre='" . htmlspecialchars($finca->nombre) . "' 
                      data-propietario='" . htmlspecialchars($finca->codigo_propietario) . "' 
                      data-capataz='" . htmlspecialchars($finca->codigo_capataz) . "' 
                      data-vendedor='" . htmlspecialchars($finca->codigo_vendedor) . "' 
                      data-pais='" . htmlspecialchars($finca->pais) . "' 
                      data-departamento='" . htmlspecialchars($finca->departamento) . "' 
                      data-ciudad='" . htmlspecialchars($finca->ciudad) . "' 
                      data-metros='" . htmlspecialchars($finca->metrosCuadrados) . "' 
                      data-hectareas='" . htmlspecialchars($finca->numHectareas) . "' 
                      data-leche='" . htmlspecialchars($finca->siProduceLeche) . "' 
                      data-cereales='" . htmlspecialchars($finca->siProduceCereales) . "' 
                      data-frutas='" . htmlspecialchars($finca->siProduceFrutas) . "' 
                      data-verduras='" . htmlspecialchars($finca->siProduceVerduras) . "'>
                  Ver
                  </button>
                  <form action='../../Controllers/deleteFincaController.php' method='POST' style='display:inline;'>
                  <input type='hidden' name='codigo_finca' value='" . htmlspecialchars($finca->codigo_finca) . "'>
                  <button type='submit'>Eliminar</button>
                  </form>
                  </td>";
                  echo "</tr>";
                }
            } catch (Exception $e) {
                echo "<tr><td colspan='8'>Error al obtener las fincas: " . $e->getMessage() . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

     <!-- <div class="filters">
        <span>PROPIETARIO</span>
        <span>VENDEDOR</span>
        <span>CAPATAZ</span>
        <span>CIUDAD</span>
        <div class="input-group">
          <input type="text" placeholder="Filtrar..." />
          <button>&#128269;</button>
        </div>
      </div> -->
    </main>
  </div>

  <div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Editar Finca</h2>
      <form id="editForm" action="../../Controllers/updateFincaController.php" method="POST">
        <input type="hidden" name="codigo_finca" id="codigo_finca">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="codigo_propietario">Código del Propietario:</label>
        <input type="text" name="codigo_propietario" id="codigo_propietario" required>
        
        <label for="codigo_capataz">Código del Capataz:</label>
        <input type="text" name="codigo_capataz" id="codigo_capataz" required>
        
        <label for="codigo_vendedor">Código del Vendedor:</label>
        <input type="text" name="codigo_vendedor" id="codigo_vendedor" required>
        
        <label for="siProduceLeche">¿Produce Leche?</label>
        <select name="siProduceLeche" id="siProduceLeche" required>
          <option value="1">Sí</option>
          <option value="0">No</option>
        </select>
        
        <label for="siProduceCereales">¿Produce Cereales?</label>
        <select name="siProduceCereales" id="siProduceCereales" required>
          <option value="1">Sí</option>
          <option value="0">No</option>
        </select>
        
        <label for="siProduceFrutas">¿Produce Frutas?</label>
        <select name="siProduceFrutas" id="siProduceFrutas" required>
          <option value="1">Sí</option>
          <option value="0">No</option>
        </select>
        
        <label for="siProduceVerduras">¿Produce Verduras?</label>
        <select name="siProduceVerduras" id="siProduceVerduras" required>
          <option value="1">Sí</option>
          <option value="0">No</option>
        </select>
        
        <button type="submit">Guardar Cambios</button>
      </form>
    </div>
  </div>

  <div id="viewModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Información de la Finca</h2>
    <p><strong>Código:</strong> <span id="view-codigo"></span></p>
    <p><strong>Nombre:</strong> <span id="view-nombre"></span></p>
    <p><strong>Código del Propietario:</strong> <span id="view-propietario"></span></p>
    <p><strong>Código del Capataz:</strong> <span id="view-capataz"></span></p>
    <p><strong>Código del Vendedor:</strong> <span id="view-vendedor"></span></p>
    <p><strong>País:</strong> <span id="view-pais"></span></p>
    <p><strong>Departamento:</strong> <span id="view-departamento"></span></p>
    <p><strong>Ciudad:</strong> <span id="view-ciudad"></span></p>
    <p><strong>Metros Cuadrados:</strong> <span id="view-metros"></span></p>
    <p><strong>Número de Hectáreas:</strong> <span id="view-hectareas"></span></p>
    <p><strong>¿Produce Leche?:</strong> <span id="view-leche"></span></p>
    <p><strong>¿Produce Cereales?:</strong> <span id="view-cereales"></span></p>
    <p><strong>¿Produce Frutas?:</strong> <span id="view-frutas"></span></p>
    <p><strong>¿Produce Verduras?:</strong> <span id="view-verduras"></span></p>
  </div>
</div>

<div id="fincaModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close-btn" onclick="document.getElementById('fincaModal').style.display='none'">&times;</span>
    <h2>Información de la Finca</h2>
    <p><strong>Código:</strong> <?= htmlspecialchars($_GET['codigo_finca']) ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($_GET['nombre']) ?></p>
    <p><strong>País:</strong> <?= htmlspecialchars($_GET['pais']) ?></p>
    <p><strong>Departamento:</strong> <?= htmlspecialchars($_GET['departamento']) ?></p>
    <p><strong>Ciudad:</strong> <?= htmlspecialchars($_GET['ciudad']) ?></p>
    <p><strong>Metros Cuadrados:</strong> <?= htmlspecialchars($_GET['metros']) ?></p>
    <p><strong>Número de Hectáreas:</strong> <?= htmlspecialchars($_GET['hectareas']) ?></p>
    <p><strong>¿Produce Leche?:</strong> <?= htmlspecialchars($_GET['leche']) == 1 ? 'Sí' : 'No' ?></p>
    <p><strong>¿Produce Cereales?:</strong> <?= htmlspecialchars($_GET['cereales']) == 1 ? 'Sí' : 'No' ?></p>
    <p><strong>¿Produce Frutas?:</strong> <?= htmlspecialchars($_GET['frutas']) == 1 ? 'Sí' : 'No' ?></p>
    <p><strong>¿Produce Verduras?:</strong> <?= htmlspecialchars($_GET['verduras']) == 1 ? 'Sí' : 'No' ?></p>
  </div>
</div>

</body>

<script>
  const error = "<?= htmlspecialchars($_GET['error']) ?>";
  if (error === 'not_found') {
    alert('Error: La finca no fue encontrada.');
  } else if (error === 'missing_id') {
    alert('Error: No se proporcionó un código de finca.');
  } else {
    alert('Error: ' + error);
  }
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('editModal');
  const closeBtn = document.querySelector('.close-btn');
  const editButtons = document.querySelectorAll('.edit-btn');

  editButtons.forEach(button => {
    button.addEventListener('click', () => {

      document.getElementById('codigo_finca').value = button.dataset.codigo;
      document.getElementById('nombre').value = button.dataset.nombre;
      document.getElementById('codigo_propietario').value = button.dataset.propietario;
      document.getElementById('codigo_capataz').value = button.dataset.capataz;
      document.getElementById('codigo_vendedor').value = button.dataset.vendedor;
      document.getElementById('siProduceLeche').value = button.dataset.leche;
      document.getElementById('siProduceCereales').value = button.dataset.cereales;
      document.getElementById('siProduceFrutas').value = button.dataset.frutas;
      document.getElementById('siProduceVerduras').value = button.dataset.verduras;

      modal.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const viewModal = document.getElementById('viewModal');
  const closeBtn = viewModal.querySelector('.close-btn');
  const viewButtons = document.querySelectorAll('.view-btn');

  viewButtons.forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('view-codigo').textContent = button.dataset.codigo;
      document.getElementById('view-nombre').textContent = button.dataset.nombre;
      document.getElementById('view-propietario').textContent = button.dataset.propietario;
      document.getElementById('view-capataz').textContent = button.dataset.capataz;
      document.getElementById('view-vendedor').textContent = button.dataset.vendedor;
      document.getElementById('view-pais').textContent = button.dataset.pais;
      document.getElementById('view-departamento').textContent = button.dataset.departamento;
      document.getElementById('view-ciudad').textContent = button.dataset.ciudad;
      document.getElementById('view-metros').textContent = button.dataset.metros;
      document.getElementById('view-hectareas').textContent = button.dataset.hectareas;
      document.getElementById('view-leche').textContent = button.dataset.leche === "1" ? "Sí" : "No";
      document.getElementById('view-cereales').textContent = button.dataset.cereales === "1" ? "Sí" : "No";
      document.getElementById('view-frutas').textContent = button.dataset.frutas === "1" ? "Sí" : "No";
      document.getElementById('view-verduras').textContent = button.dataset.verduras === "1" ? "Sí" : "No";

      viewModal.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', () => {
    viewModal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === viewModal) {
      viewModal.style.display = 'none';
    }
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const fincaModal = document.getElementById('fincaModal');

  const urlParams = new URLSearchParams(window.location.search);
  const codigoFinca = urlParams.get('codigo_finca');

  if (codigoFinca) {
    fincaModal.style.display = 'flex';
  }

  const closeBtn = fincaModal.querySelector('.close-btn');
  closeBtn.addEventListener('click', () => {
    fincaModal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === fincaModal) {
      fincaModal.style.display = 'none';
    }
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get('error');

  if (error) {
    switch (error) {
      case 'finca_not_found':
        alert('Error: No se encontró ninguna finca con el criterio proporcionado.');
        break;
      case 'empty_search':
        alert('Error: El campo de búsqueda está vacío.');
        break;
      case 'error_searching_finca':
        alert('Error: Ocurrió un problema al buscar la finca. Inténtalo nuevamente.');
        break;
      default:
        alert('Error desconocido: ' + error);
        break;
    }
  }
});
</script>

</html>