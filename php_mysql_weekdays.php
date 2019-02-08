//for getting weekdays
// returns array of dates
function get_weekdays_between($end_date = "", $start_date = "", $ref_tz = "UTC" ){
    if (!$end_date && !$start_date) return false;
    $date_collection;
	$sql = "
        SELECT selected_date FROM (
            SELECT * FROM (
                SELECT adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
                    (SELECT 0 i 
                        UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 
                        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
                    (SELECT 0 i 
                        UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 
                        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
                    (SELECT 0 i 
                        UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 
                        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
                    (SELECT 0 i 
                        UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 
                        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
                    (SELECT 0 i 
                        UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 
                        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4
                ) v
            WHERE selected_date BETWEEN CONVERT_TZ('{$start_date}', '{$ref_tz}', 'UTC') 
                AND CONVERT_TZ('{$start_date}', '{$ref_tz}', 'UTC') 
        ) r 
        WHERE WEEKDAY(selected_date) > 0 
            AND WEEKDAY(selected_date)<6        
    ";

    // DECLARE YOUR mysqli connection!
    // you will have $db missing error!
    $res = $db->query($sql); 
    
    while ($row = $res->fetch_assoc()){
        $date_collection[] = $row["selected_date"];
    }
    return $date_collection;
}
