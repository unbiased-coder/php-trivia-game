<?php
    // gets and sanitizes the category and date from the web request
    // returns an array the first element is the date and the second the category
    function get_category_date()
    {
        if(!isset($_GET["date"]) || !isset($_GET['category'])){
            http_response_code(404);
            die();
        }

        $date = htmlspecialchars($_GET["date"]);
        $category = htmlspecialchars($_GET['category']);
        return [$date, $category];
    }
?>