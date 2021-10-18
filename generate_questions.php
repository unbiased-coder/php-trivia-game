<?php
    require __DIR__ . '/csv_helper.php';
    require __DIR__ . '/request_helper.php';

    [$date, $category] = get_category_date();
    $csv = get_csv_into_array($date, $category);
    $capital_category = ucfirst($category);
?>


<html>
    <head>
        <title>Trivia <?php echo $capital_category; ?> Questions</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>

        <script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <?php
            echo "<nav class='navbar navbar-light'>\n";
            echo "<div class='p-3 mb-2 bg-info text-white'><h2>Trivia $capital_category Questions</h2></div>\n";
            echo "</nav>";
            echo "<form method='POST' action='/process_results.php?date={$date}&category={$category}'>\n";
            $question_number = 0;
            foreach($csv as $row){
                $question = $row[0];

                echo "<div class='card bg-light mb-3' style='max-width: 100%;'>\n";
                echo "<div class='card-header'>$question</div>\n";
                unset($row[0]);
                shuffle($row);

                echo "<div class='card-body'>\n";
                for($i=0;$i<count($row);$i++){
                    echo "<p class='card-text'>\n<input class='form-check-input' type='radio' name='{$question_number}' value='$row[$i]'";
                    if($i==0)
                        echo " checked>\n";
                    else
                        echo ">\n";
                    echo "<label class='form-check-label' for='$row[$i]'>$row[$i]</label></p>\n";
                }
                echo "</div></div>";
                $question_number++;
            }
            echo "<input class='btn btn-info cyan-button' type='submit' value='Send Answers'>";
            echo "</form>";
        ?>
    </body>
</html>