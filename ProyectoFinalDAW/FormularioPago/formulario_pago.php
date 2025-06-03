<?php
session_start();
$tipo = $_GET['tipo'] ?? '';

if (!in_array($tipo, ['compra', 'alquiler'])) {
    die("Tipo de operación no válida.");
}

if ($tipo === 'compra' && empty($_SESSION['cesta'])) {
    header("Location: ver_cesta.php");
    exit;
}
if ($tipo === 'alquiler' && empty($_SESSION['cesta_alquiler'])) {
    header("Location: ver_cesta_alquiler.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            background-color: #f8f9fa;
        }
        .center-container {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .payment-form {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 1rem rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container center-container">
    <div class="payment-form">
        <h3 class="mb-4 text-center">💳 Datos de Pago - <?= ucfirst($tipo) ?></h3>

        <?php if (isset($_SESSION['error_pago'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error_pago']) ?>
            </div>
            <?php unset($_SESSION['error_pago']); ?>
        <?php endif; ?>

        <form action="procesar_pago.php" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre en la tarjeta</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">Introduce el nombre del titular.</div>
            </div>

            <div class="mb-3">
                <label for="tarjeta" class="form-label">Número de tarjeta</label>
                <input type="text" class="form-control" id="tarjeta" name="tarjeta" pattern="\d{16}" required>
                <div class="invalid-feedback">Número de tarjeta no válido (16 dígitos sin espacios).</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="caducidad" class="form-label">Caducidad (MM/AA)</label>
                    <input type="text" class="form-control" id="caducidad" name="caducidad" placeholder="MM/AA" pattern="^(0[1-9]|1[0-2])\/\d{2}$" required>
                    <div class="invalid-feedback">Introduce una fecha válida en formato MM/AA.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" pattern="\d{3}" required>
                    <div class="invalid-feedback">Introduce un CVV válido (3 dígitos).</div>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Confirmar Pago</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Validación visual Bootstrap
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // Autoformato MM/AA
    document.getElementById("caducidad").addEventListener("input", function (e) {
        let value = e.target.value.replace(/[^\d]/g, '');
        if (value.length >= 2 && !value.includes('/')) {
            e.target.value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
    });
</script>
</body>
</html>
