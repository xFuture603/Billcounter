<?php
function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( tablecontent_name LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR tablecontent_amount LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR tablecontent_age LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // Nehmen von allen Einträgen ohne Suche
		$sql = "SELECT * FROM `tablecontent` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//Verknüpfte sql Suche, falls Eintrag existiert
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("Fehler: kann keine toten Tabelleninhalte abrufen!");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("Error: kann keine Tabelleninhalte synchronisieren!");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // Array für komplette Daten
			);
		return $json_data;
	}
    