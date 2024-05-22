<?php
require_once './db_config.php';

// Build the query based on the provided search criteria
$query = "SELECT * FROM pets WHERE 1 = 1"; // Start with a condition that's always true
$params = [];

foreach ($_GET as $key => $value) {
    if (!empty($value)) {
        // Special handling for the age parameter
        if ($key === 'age') {
            switch ($value) {
                case '0-1':
                    $query .= " AND age <= ?";
                    $params[] = 1;
                    break;
                case '1-5':
                    $query .= " AND age > ? AND age <= ?";
                    $params[] = 1;
                    $params[] = 5;
                    break;
                case '5+':
                    $query .= " AND age > ?";
                    $params[] = 5;
                    break;
            }
        } else {
            $query .= " AND $key = ?";
            $params[] = $value;
        }
    }
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$petIDs=[];
$counter =1;
foreach($results as $pet){
    $petIDs[]=$pet['petID'];

}
$petIDsString = implode(',', $petIDs);
if(empty($petIDsString)){
    $petIDsString = "not found";    
}
// Redirect with the petIDs as a URL parameter
header("Location: http://localhost/PawPrints/search.php?petIds=" . urlencode($petIDsString));
exit(); 
?>
