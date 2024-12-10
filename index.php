<?php
    include_once('header.php');
    session_start();
    session_destroy();
?>
<main class="big_box_flex">
    <div class="size_box_flex flex-dir-col">
        <?php
        if(str_contains($_SERVER['REQUEST_URI'], "index.php")){
            if(isset($_GET["type"]) && in_array($_GET["type"], $array)) {
                session_start();
                $_SESSION["type"] = $_GET["type"];
            ?>
            <form action="results.php" method="POST" class="flexbox flex-dir-col">
            <h2>Conversion data</h2>
            <div class="flexbox form_convert_question">
                Convert&nbsp;
                <input type="number" name="start_value" id="start_value" step="any" onkeyup="start_func()">
                <select name="first_select" id="first_select" required onchange="select_1()">
                <option value="" selected disabled>-- select --</option>
                <?php
                    $query = "SELECT full_name, abbreviation FROM ".$_GET["type"]."_units";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo $row["abbreviation"]; ?>">
                            <?php echo $row["full_name"]." (".$row["abbreviation"].")"; ?>
                    </option>
                        <?php
                    }
                    ?>
                </select>
                to
                <select name="second_select" id="second_select" required onchange="select_2()">
                <option value="" selected disabled>-- select --</option>
                <?php
                    $query = "SELECT full_name, abbreviation FROM ".$_GET["type"]."_units";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo $row["abbreviation"]; ?>">
                            <?php echo $row["full_name"]." (".$row["abbreviation"].")"; ?>
                    </option>
                        <?php
                    }
                    ?>
                </select>
                <button type="button" class="exchange_values" onclick="swap_select()"><i class="fas fa-exchange-alt"></i></button>
            </div>            
            <?php include_once('form_routine_questions.php'); ?>
            <button type="submit" id="submit_form" disabled>Calculate</button>
            </form>
            <?php }
            else if (
                (isset($_GET["type"]) && !in_array($_GET["type"], $array))
                || (str_contains($_SERVER['REQUEST_URI'], "?"))
                )  {
                    http_response_code(404);
                ?>
                <p class="error_message">The page you are trying to acces does not exist</p>
                <?php
            }

                if(
                    (str_contains($_SERVER['REQUEST_URI'], "index.php")
                    && str_contains($_SERVER['REQUEST_URI'], "?type=".!in_array($_GET["type"], $array)))
                    ||
                    (str_contains($_SERVER['REQUEST_URI'], "index.php")
                    && !str_contains($_SERVER['REQUEST_URI'], "?"))
                    ) {
                        include_once('tiles_collection.php');
                    }
            }
            if(
                (str_contains($_SERVER['REQUEST_URI'], "/calculator/")
                && !str_contains($_SERVER['REQUEST_URI'], "index.php"))
                ) {
                    include_once('tiles_collection.php');
                }
            ?>
    </div>
</main>
<?php include_once('footer.php'); ?>