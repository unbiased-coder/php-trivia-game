<?php
    require __DIR__ . '/csv_helper.php';
    require __DIR__ . '/request_helper.php';

    [$date, $category] = get_category_date();
    $csv = get_csv_into_array($date, $category);
    $capital_category = ucfirst($category);
?>

<html>
<head>
        <title>Trivia <?php echo $capital_category; ?> Results</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>

        <script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <?php
            echo "<nav class='navbar navbar-light'>\n";
            echo "<div class='p-3 mb-2 bg-info text-white'><h2>Trivia $capital_category Results</h2></div>\n";
            echo "</nav>";
        
            $question_number = 0;
            $correct = 0;
            $wrong = 0;
            echo "<div class='card bg-light mb-3' style='max-width: 100%;'>\n";
            echo "<div class='card-header title-header'>Results</div>\n";
            foreach($csv as $row){
                $answer = $row[1];
                if(!strcmp($answer, $_POST[$question_number])){
                    echo "<p class='card-text'><button type='button' class='btn btn-success'>Correct</button> - $row[0] </p>\n";
                    $correct++;
                }
                else {
                    echo "<p class='card-text'><button type='button' class='btn btn-danger'>Wrong</button> - $row[0]\n";
                    echo "- Answer: $answer</p>";
                    $wrong++;
                }
                $question_number++;
            }
            echo "</div></div>";
            if ($correct == 0)
                $score = "0";
            else
                $score = round((($correct / $question_number)*100), 2);
            
            echo "<div class='p-3 mb-2 bg-info text-white'><h5>Your quiz score is: <b>$score%</b></div></h5></div>\n";
        ?>
    </body>
</html>