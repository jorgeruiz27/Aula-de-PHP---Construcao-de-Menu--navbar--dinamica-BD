<?php
include "./sistema/configuracao.php";
$sql = "SELECT * FROM categorias ORDER BY id";
$res = $conn->query($sql);
$resultado = $res->fetchAll(\PDO::FETCH_ASSOC);

$menuCategorias = construirMenu($resultado, 0);
function construirMenu($categorias, $nivel)
{
    $array = [];
    foreach ($categorias as $categoria) {
        if ($categoria["nivel"] == $nivel) {
            $subcategoria = construirMenu($categorias, $categoria['id']);
            if ($subcategoria) {
                $categoria['subNivel'] = $subcategoria;
            }
            $array[] = $categoria;
        }
    }
    return $array;
}

function navBar($categorias)
{
    $html = "<ul>";
    foreach ($categorias as $value) {
        $html = $html . "<li>" . $value["titulo"];
        if (isset($value["subNivel"])) {
            $html = $html . navBar($value["subNivel"]);
        }
        $html = $html . "</li>";
    }
    $html = $html . "</ul>";
    return $html;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <nav class="menu">
        <?php echo navBar($menuCategorias) ?>
    </nav>
</body>

</html>