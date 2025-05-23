<?php
session_start();
require_once '../../login.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['password'])) {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Error en la conexión.");

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_usuario, contra, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contra'])) {
            $_SESSION['id_usu'] = $row['id_usuario'];
            $_SESSION['nombreUsu'] = $username;
            $_SESSION['rol'] = $row['rol'];
            header('Location: ../../Index.php');
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $error = "Por favor, completa todos los campos correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Level-Up Video | Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title text-center mb-4">Level-Up Video</h4>

            <!-- Mensaje de error en PHP -->
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger text-center" role="alert">
                <?= htmlspecialchars($error) ?>
              </div>
            <?php endif; ?>

            <!-- Formulario de Login -->
            <form method="post" onsubmit="return validarFormulario()">
              <div class="mb-3">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="username" id="username"
                       required pattern="^[a-zA-Z0-9_]{3,20}$"
                       title="El usuario debe tener entre 3 y 20 caracteres (letras, números o guiones bajos)."
                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" required minlength="4">
              </div>
              <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </form>

            <hr class="my-3">

            <!-- Botón de Registro -->
            <form action="../Registro/registro.php" method="get">
              <button type="submit" class="btn btn-outline-secondary w-100">Registrarse</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function validarFormulario() {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();

      if (username === '' || password === '') {
        // No usar alert, puedes mostrar un mensaje personalizado aquí si quieres
        return false;
      }

      return true;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
