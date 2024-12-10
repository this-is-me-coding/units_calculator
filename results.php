<?php
    include_once('header.php');
    session_start();
    $type = $_SESSION["type"];
    
    $first_name = $_POST["first_name"];
    $email_address = $_POST["email_address"];
    $terms = $_POST["terms"];

    if(empty($first_name)){
        $first_name = "not submitted";
    }

    if(empty($email_address)){
        $email_address = "not submitted";
    }

    if($email_address!="not submitted") {
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            header('location: index.php?type='.$type.'&error=invalid_email');
        }
    }

    $start_value = $_POST["start_value"];
    $select1 = $_POST["first_select"];
    $select2 = $_POST["second_select"];

    if (!preg_match("/^(\d*\.)?\d+$/", $start_value)) {
        header('location: index.php?type='.$type.'&error=not_a_number');
    }
?>
<main class="big_box_flex flex-dir-col">
    <div class="size_box_flex results_big_box">
        <div class="flexbox flex-dir-col submitted_data">
            <h2><i class="far fa-user"></i>&nbsp;Personal data</h2>
            <p>First name: <?php echo $first_name.$filtervare; ?></p>
            <p>Email: <?php if($email_address != "not submitted"){
                ?>
                    <a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
                <?php
            } else {
                echo $email_address;
            } ?>
            </p>
            <p>Terms:
                <?php 
                    if($terms=="on") {
                        echo "agreed";
                    }
                ?>
            </p>
        </div>
        <div class="flexbox flex-dir-col results_shown">
            <?php
                $query = "SELECT type_full_name, type_icon FROM types WHERE type_site=\"".$_SESSION["type"]."\";";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)){
                ?>
                <h2 class="conversion_type">Conversion:&nbsp;&nbsp;<i class="<?php echo $row["type_icon"]; ?>"></i>&nbsp;
                    <?php echo $row["type_full_name"]; ?>
                </h2>
                <?php
                }
            ?>
            <?php
                if($type == "temperature"){
                    if(str_contains($select1, "C") || str_contains($select1, "F")){
                        $select1_calc = substr($select1, -1, 1);
                    } else {
                        $select1_calc = $select1;
                    }

                    if(str_contains($select2, "C") || str_contains($select2, "F")){
                        $select2_calc = substr($select2, -1, 1);
                    } else {
                        $select2_calc = $select2;
                    }

                    $operation = $select1_calc.$select2_calc;

                    $temperature_array = [
                        "CF" => ((($start_value*9)/5)+32),
                        "CK" => ($start_value+273.15),
                        "FC" => ((($start_value-32)*5)/9),
                        "FK" => (((($start_value-32)*5)/9)+273.15),
                        "KC" => ($start_value-273.15),
                        "KF" => (((($start_value-273.15)*9)/5)+32),
                    ];
                    $temperature_calc_array = [
                        "CF" => "\[(".$start_value.$select1."*{9 \over 5})+32=".$temperature_array[$operation].$select2."\]",
                        "CK" => "\[".$start_value.$select1."+273.15=".$temperature_array[$operation].$select2."\]",
                        "FC" => "\[(".$start_value.$select1."-32)*{5 \over 9}=".$temperature_array[$operation].$select2."\]",
                        "FK" => "\[((".$start_value.$select1."-32)*{5 \over 9})+273.15=".$temperature_array[$operation].$select2."\]",
                        "KC" => "\[".$start_value.$select1."-273.15=".$temperature_array[$operation].$select2."\]",
                        "KF" => "\[((".$start_value.$select1."-273.15)*{9 \over 5})+32=".$temperature_array[$operation].$select2."\]",
                    ];

                    if(array_key_exists($operation, $temperature_array)) {
                        $conversion_result = $temperature_array[$operation];
                        ?>
                        <h2 class="final_result">
                            <?php echo $start_value.$select1." = ".$temperature_array[$operation].$select2; ?>
                        </h2>
                        <div class="formula_result">
                            <h2>Formula</h2>
                            <?php echo $temperature_calc_array[$operation]; ?>
                        </div>
                        <?php
                    } else if(!array_key_exists($operation, $temperature_array)) {
                        header('location: index.php?type='.$type.'&error=non_existent_value');
                    }
                } 

                if($type == "weight"){
                    $operation = $select1.$select2;

                    $weight_array = [
                        "mgg" => ($start_value/1000),
                        "mgdag" => ($start_value/10000),
                        "mgkg" => ($start_value/1000000),
                        "mgt" => ($start_value/1000000000),
                        "mgoz" => ($start_value/28350),
                        "mglb" => ($start_value/453592),
                        "mgimp ton" => ($start_value/1.016e+9),
                        "mgUS ton" => ($start_value/9.072e+8),

                        "gmg" => ($start_value*1000),
                        "gdag" => ($start_value/10),
                        "gkg" => ($start_value/1000),
                        "gt" => ($start_value/1e+6),
                        "goz" => ($start_value/28.35),
                        "glb" => ($start_value/454),
                        "gimp ton" => ($start_value/1.016e+9),
                        "gUS ton" => ($start_value/907185),

                        "dagmg" => ($start_value*10000),
                        "dagg" => ($start_value*10),
                        "dagkg" => ($start_value/100),
                        "dagt" => ($start_value/100000),
                        "dagoz" => ($start_value/2.835),
                        "daglb" => ($start_value/45.359),
                        "dagimp ton" => ($start_value/101605),
                        "dagUS ton" => ($start_value/90718),

                        "kgmg" => ($start_value*1e+6),
                        "kgg" => ($start_value*1000),
                        "kgdag" => ($start_value*100),
                        "kgt" => ($start_value/1000),
                        "kgoz" => ($start_value*35.274),
                        "kglb" => ($start_value*2.205),
                        "kgimp ton" => ($start_value/1016),
                        "kgUS ton" => ($start_value/907),

                        "tmg" => ($start_value*1e+9),
                        "tg" => ($start_value*1e+6),
                        "tdag" => ($start_value*100000),
                        "tkg" => ($start_value*1000),
                        "toz" => ($start_value*35274),
                        "tlb" => ($start_value*2205),
                        "timp ton" => ($start_value/1.016),
                        "tUS ton" => ($start_value*1.102),

                        "ozmg" => ($start_value*28350),
                        "ozg" => ($start_value*28.35),
                        "ozdag" => ($start_value*2.835),
                        "ozkg" => ($start_value/35.274),
                        "ozt" => ($start_value/35274),
                        "ozlb" => ($start_value/16),
                        "ozimp ton" => ($start_value/35840),
                        "ozUS ton" => ($start_value/32000),
                        
                        "lbmg" => ($start_value*453592),
                        "lbg" => ($start_value*454),
                        "lbdag" => ($start_value*45.359),
                        "lbkg" => ($start_value/2.205),
                        "lbt" => ($start_value/2205),
                        "lboz" => ($start_value*16),
                        "lbimp ton" => ($start_value/2240),
                        "lbUS ton" => ($start_value/2000),

                        "imp tonmg" => ($start_value*1.016e+9),
                        "imp tong" => ($start_value*1.016e+6),
                        "imp tondag" => ($start_value*101605),
                        "imp tonkg" => ($start_value*1016),
                        "imp tont" => ($start_value*1.016),
                        "imp tonoz" => ($start_value*35840),
                        "imp tonlb" => ($start_value*2240),
                        "imp tonUS ton" => ($start_value*1.12),

                        "US tonmg" => ($start_value*9.072e+8),
                        "US tong" => ($start_value*907185),
                        "US tondag" => ($start_value*90718),
                        "US tonkg" => ($start_value*907),
                        "US tont" => ($start_value/1.102),
                        "US tonoz" => ($start_value*32000),
                        "US tonlb" => ($start_value*2000),
                        "US tonimp ton" => ($start_value/1.12),
                    ];

                    if(array_key_exists($operation, $weight_array)) {
                        $conversion_result = $weight_array[$operation];
                        ?>
                        <h2 class="final_result">
                            <?php echo $start_value." ".$select1." = ".$weight_array[$operation]." ".$select2; ?>
                        </h2>
                        <?php
                    } else if(!array_key_exists($operation, $weight_array)) {
                        header('location: index.php?type='.$type.'&error=non_existent_value');
                    }
                }

                if($type == "length"){
                    $operation = $select1.$select2;

                    $length_array = [
                        // metric to metric
                        "mmcm" =>   ($start_value/10),
                        "mmdm" =>   ($start_value/100),
                        "mmm" =>    ($start_value/1000),
                        "mmdcm" =>  ($start_value/10000),
                        "mmhm" =>   ($start_value/100000),
                        "mmkm" =>   ($start_value/1000000),

                        "cmmm" =>   ($start_value*10),
                        "cmdm" =>   ($start_value/10),
                        "cmm" =>    ($start_value/100),
                        "cmdcm" =>  ($start_value/1000),
                        "cmhm" =>   ($start_value/10000),
                        "cmkm" =>   ($start_value/100000),

                        "dmmm" =>   ($start_value*100),
                        "dmcm" =>   ($start_value*10),
                        "dmm" =>    ($start_value/10),
                        "dmdcm" =>  ($start_value/100),
                        "dmhm" =>   ($start_value/1000),
                        "dmkm" =>   ($start_value/10000),

                        "mmm" =>    ($start_value*1000),
                        "mcm" =>    ($start_value*100),
                        "mdm" =>    ($start_value*10),
                        "mdcm" =>   ($start_value/10),
                        "mhm" =>    ($start_value/100),
                        "mkm" =>    ($start_value/1000),

                        "dcmmm" =>  ($start_value*10000),
                        "dcmcm" =>  ($start_value*1000),
                        "dcmdm" =>  ($start_value*100),
                        "dcmm" =>   ($start_value*10),
                        "dcmhm" =>  ($start_value/10),
                        "dcmkm" =>  ($start_value/100),

                        "hmmm" =>   ($start_value*100000),
                        "hmcm" =>   ($start_value*10000),
                        "hmdm" =>   ($start_value*1000),
                        "hmm" =>    ($start_value*100),
                        "hmdcm" =>  ($start_value*10),
                        "hmkm" =>   ($start_value/10),

                        "kmmm" =>   ($start_value*1000000),
                        "kmcm" =>   ($start_value*100000),
                        "kmdm" =>   ($start_value*10000),
                        "kmm" =>    ($start_value*1000),
                        "kmdcm" =>  ($start_value*100),
                        "kmhm" =>   ($start_value*10),

                        // imperial to metric
                        "incm" => ($start_value*2.54),
                        "inmm" => (($start_value*2.54)*10),
                        "indm" => (($start_value*2.54)/10),
                        "inm" => (($start_value*2.54)/100),
                        "indcm" => (($start_value*2.54)/1000),
                        "inhm" => (($start_value*2.54)/10000),
                        "inkm" => (($start_value*2.54)/100000),

                        //metric to imperial
                        "cmin" => ($start_value/2.54),
                        "mmin" => (($start_value/2.54)/10),
                        "dmin" => (($start_value/2.54)*10),
                        "min" => (($start_value/2.54)*100),
                        "dcmin" => (($start_value/2.54)*1000),
                        "hmin" => (($start_value/2.54)*10000),
                        "kmin" => (($start_value/2.54)*100000),
                    ];
                    
                    $length_calc_array = [
                        // metric to metric
                        "mmcm" =>   "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",
                        "mmdm" =>   "\[{".$start_value.$select1." \over 100}=".$length_array[$operation].$select2."\]",
                        "mmm" =>    "\[{".$start_value.$select1." \over 1000}=".$length_array[$operation].$select2."\]",
                        "mmdcm" =>  "\[{".$start_value.$select1." \over 10000}=".$length_array[$operation].$select2."\]",
                        "mmhm" =>   "\[{".$start_value.$select1." \over 100000}=".$length_array[$operation].$select2."\]",
                        "mmkm" =>   "\[{".$start_value.$select1." \over 1000000}=".$length_array[$operation].$select2."\]",

                        "cmmm" =>   "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",
                        "cmdm" =>   "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",
                        "cmm" =>    "\[{".$start_value.$select1." \over 100}=".$length_array[$operation].$select2."\]",
                        "cmdcm" =>  "\[{".$start_value.$select1." \over 1000}=".$length_array[$operation].$select2."\]",
                        "cmhm" =>   "\[{".$start_value.$select1." \over 10000}=".$length_array[$operation].$select2."\]",
                        "cmkm" =>   "\[{".$start_value.$select1." \over 100000}=".$length_array[$operation].$select2."\]",

                        "dmmm" =>   "\[{".$start_value.$select1." * 100}=".$length_array[$operation].$select2."\]",
                        "dmcm" =>   "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",
                        "dmm" =>    "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",
                        "dmdcm" =>  "\[{".$start_value.$select1." \over 100}=".$length_array[$operation].$select2."\]",
                        "dmhm" =>   "\[{".$start_value.$select1." \over 1000}=".$length_array[$operation].$select2."\]",
                        "dmkm" =>   "\[{".$start_value.$select1." \over 10000}=".$length_array[$operation].$select2."\]",

                        "mmm" =>    "\[{".$start_value.$select1." * 1000}=".$length_array[$operation].$select2."\]",
                        "mcm" =>    "\[{".$start_value.$select1." * 100}=".$length_array[$operation].$select2."\]",
                        "mdm" =>    "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",
                        "mdcm" =>   "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",
                        "mhm" =>    "\[{".$start_value.$select1." \over 100}=".$length_array[$operation].$select2."\]",
                        "mkm" =>    "\[{".$start_value.$select1." \over 1000}=".$length_array[$operation].$select2."\]",

                        "dcmmm" =>  "\[{".$start_value.$select1." * 10000}=".$length_array[$operation].$select2."\]",
                        "dcmcm" =>  "\[{".$start_value.$select1." * 1000}=".$length_array[$operation].$select2."\]",
                        "dcmdm" =>  "\[{".$start_value.$select1." * 100}=".$length_array[$operation].$select2."\]",
                        "dcmm" =>   "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",
                        "dcmhm" =>  "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",
                        "dcmkm" =>  "\[{".$start_value.$select1." \over 100}=".$length_array[$operation].$select2."\]",

                        "hmmm" =>   "\[{".$start_value.$select1." * 100000}=".$length_array[$operation].$select2."\]",
                        "hmcm" =>   "\[{".$start_value.$select1." * 10000}=".$length_array[$operation].$select2."\]",
                        "hmdm" =>   "\[{".$start_value.$select1." * 1000}=".$length_array[$operation].$select2."\]",
                        "hmm" =>    "\[{".$start_value.$select1." * 100}=".$length_array[$operation].$select2."\]",
                        "hmdcm" =>  "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",
                        "hmkm" =>   "\[{".$start_value.$select1." \over 10}=".$length_array[$operation].$select2."\]",

                        "kmmm" =>   "\[{".$start_value.$select1." * 1000000}=".$length_array[$operation].$select2."\]",
                        "kmcm" =>   "\[{".$start_value.$select1." * 100000}=".$length_array[$operation].$select2."\]",
                        "kmdm" =>   "\[{".$start_value.$select1." * 10000}=".$length_array[$operation].$select2."\]",
                        "kmm" =>    "\[{".$start_value.$select1." * 1000}=".$length_array[$operation].$select2."\]",
                        "kmdcm" =>  "\[{".$start_value.$select1." * 100}=".$length_array[$operation].$select2."\]",
                        "kmhm" =>   "\[{".$start_value.$select1." * 10}=".$length_array[$operation].$select2."\]",

                        // imperial to metric
                        "incm" => "\[".$start_value.$select1."*2.54=".$length_array[$operation].$select2."\]",
                        "inmm" => "\[(".$start_value.$select1."*2.54)*10=".$length_array[$operation].$select2."\]",
                        "indm" => "\[(".$start_value.$select1."*2.54)/10=".$length_array[$operation].$select2."\]",
                        "inm" => "\[(".$start_value.$select1."*2.54)/100=".$length_array[$operation].$select2."\]",
                        "indcm" => "\[(".$start_value.$select1."*2.54)/1000=".$length_array[$operation].$select2."\]",
                        "inhm" => "\[(".$start_value.$select1."*2.54)/10000=".$length_array[$operation].$select2."\]",
                        "inkm" => "\[(".$start_value.$select1."*2.54)/100000=".$length_array[$operation].$select2."\]",

                        //metric to imperial
                        "cmin" => "\[".$start_value.$select1."/2.54=".$length_array[$operation].$select2."\]",
                        "mmin" => "\[(".$start_value.$select1."/2.54)/10=".$length_array[$operation].$select2."\]",
                        "dmin" => "\[(".$start_value.$select1."/2.54)*10=".$length_array[$operation].$select2."\]",
                        "min" => "\[(".$start_value.$select1."/2.54)*100=".$length_array[$operation].$select2."\]",
                        "dcmin" => "\[(".$start_value.$select1."/2.54)*1000=".$length_array[$operation].$select2."\]",
                        "hmin" => "\[(".$start_value.$select1."/2.54)*10000=".$length_array[$operation].$select2."\]",
                        "kmin" => "\[(".$start_value.$select1."/2.54)*100000=".$length_array[$operation].$select2."\]",
                    ];

                    if(array_key_exists($operation, $length_array)) {
                        $conversion_result = $length_array[$operation];
                        ?>
                        <h2 class="final_result">
                            <?php echo $start_value." ".$select1." = ".$conversion_result." ".$select2; ?>
                        </h2>
                        <div class="formula_result">
                            <h2>Formula</h2>
                            <?php
                            echo $length_calc_array[$operation]; ?>
                        </div>
                        <?php
                    } else if(!array_key_exists($operation, $length_array)) {
                        header('location: index.php?type='.$type.'&error=non_existent_value');
                    }
                }

                // if(!(isset($_SESSION["inserted"]))){
                    $query = "INSERT INTO results(result_start_value, result_select_1, result_converted, result_select_2, result_first_name, result_email, result_terms) VALUES('$start_value', '$select1', '$conversion_result', '$select2', '$first_name', '$email_address', '$terms')";
                    mysqli_query($conn, $query);
                    // $_SESSION["inserted"] = "inserted";
                // }
            ?>
        </div>
    </div>
    <div class="flexbox back_buttons">
        <button type="button" class="button_go_back" onclick="back_type('<?php echo $type; ?>')">Calculate the <?php echo $type; ?> again</button>
        <button type="button" class="button_go_back" onclick="back_home()">Go back to home site</button>
    </div>
</main>
<?php
    include_once('footer.php');