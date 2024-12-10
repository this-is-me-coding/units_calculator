<?php
    $servername = "localhost";
    $server_username = "root";
    $server_password = "";
    $server_dbname = "calculator_4T_06";

    $conn = mysqli_connect($servername, $server_username, $server_password, $server_dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#7882A4;">
    <title>Calculator - Numbers made easy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="script.js"></script>
</head>
<body onload="active_tile()">
    <header class="big_box_flex navbar">
        <div class="size_box_flex">
            <a href="index.php"><img class="logo logo_header" src="logo.png"></a>
            <?php
                if (str_contains($_SERVER['REQUEST_URI'], "index.php")){
                    $query = "SELECT type_site FROM types;";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)){
                        $array[] = $row["type_site"];
                    }
                    if(isset($_GET["type"]) && in_array($_GET["type"], $array)) {
                        $query = "SELECT type_full_name, type_tile_description, type_site, type_icon FROM types WHERE type_site=\"".$_GET["type"]."\";";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)){
                        ?>
                        <h2><i class="<?php echo $row["type_icon"]; ?>"></i>&nbsp;&nbsp;<?php echo $row["type_full_name"]; ?></h2>
                        <?php }
                    } else if(isset($_GET["type"]) && !in_array($_GET["type"], $array))  {
                        ?>
                        <h2>Error</h2>
                        <?php
                    }
                }
                if (str_contains($_SERVER['REQUEST_URI'], "results.php")){
                    echo "<h2>Results</h2>";
                }
            ?>
        </div>
    </header>