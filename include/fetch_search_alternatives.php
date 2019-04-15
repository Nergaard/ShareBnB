<?php 
	include_once('../include/pdo_con_inc.php');

	$where = $_GET['q'];
	
    global $pdo;
		$query = $pdo->prepare("SELECT DISTINCT residence_city
                                FROM residence
                                WHERE residence_city LIKE ?
                                ORDER BY residence_city ASC");
		$query->bindValue(1, $where.'%');
		$query->execute();
        $query = $query->fetchAll();
        echo '<a id="remove_search_results" onclick="remove_search_results()" name="">- Close -</a>';
        foreach ($query as $this_city) {
            echo '<a onclick="insert_result_in_search(this)" name="',ucfirst($this_city['residence_city']),'">',ucfirst($this_city['residence_city']),'</a>';
        }

?>
