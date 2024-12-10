<div class="tiles_collection">
        <?php
        if (str_contains($_SERVER['REQUEST_URI'], "index.php")){
            $query = "SELECT type_site FROM types;";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)){
                $array[] = $row["type_site"];
            }
            if(isset($_GET["type"]) && in_array($_GET["type"], $array)) {
                ?>
                <h2 class="collection_title"> <?php
                echo "Other conversions";
                ?>
                </h2><?php
            }
        }
        ?>
    <?php
        $query = "SELECT type_full_name, type_tile_description, type_site, type_icon FROM types;";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)){
    ?>
    <a class="tile-link <?php echo $row["type_site"]."_tile"; ?>" href="<?php echo "index.php?type=".$row["type_site"]; ?>">
        <div class="tile">
            <i class="<?php echo $row["type_icon"]; ?>"></i>
            <div>
                <h2><?php echo $row["type_full_name"]; ?></h2>
                <h4><?php echo $row["type_tile_description"]; ?></h4>
            </div>
        </div>
    </a>
    <?php } ?>
</div>