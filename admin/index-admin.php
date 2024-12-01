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
                    case 'editar':
                        include 'editar.php';
                        break;
                    default:
                        echo '<p>Página no encontrada.</p>';
                        break;
                }
            } else {
                echo '<div class="container-fluid">';
                echo '<br>';
                echo '</div>';
            }
            ?>
        </div>
    </main>
<?php include 'footer.php'; ?>

