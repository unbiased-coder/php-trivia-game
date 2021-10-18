<?php
    // Gets a csv from GET parameters and returns an array
    function get_csv_into_array($date, $category)
    {
        $file_loc = "database/{$category}/{$date}.csv";
        if (file_exists($file_loc))
            return array_map('str_getcsv', file($file_loc));
        else {
            http_response_code(404);
            die();
        }
    }
?>
