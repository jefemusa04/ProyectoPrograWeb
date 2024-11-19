<?php include 'header.php'; ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'inventario':
                        include 'inventario.php';
                        break;
                    case 'registrar':
                        include 'registrar.php';
                        break;
                    default:
                        echo '<p>Página no encontrada.</p>';
                        break;
                }
            } else {
                echo '<h1 class="mt-4">Dashboard</h1>';
                echo '<p>Bienvenido al panel de administración.</p>';
            }
            ?>
        </div>
    </main>
<?php include 'footer.php'; ?>

