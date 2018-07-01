<?php

/**
* 
*/
require_once 'DB.php';
class DB_action extends DB
{
	
	function __construct(){
		$this->conn = $this->connect();
	}

	public function get($qry, $opt = 0){
		$result = $this->conn->query($qry);
		$return = array();
		if($opt == 0) {
			while ($obj = $result->fetch_object()) {
		        array_push($return, $obj);
		    }
		}else{
			while ($obj = $result->fetch_array(MYSQLI_ASSOC)) {
		        array_push($return, $obj);
		    }
		}
	    return $return;
	}

	public function add($tablename, $inp) {
        if(!is_array($inp))
        	return 0;
        $cols = '(';
        $vals = '(';
        $k = 1;
        foreach ($inp as $col => $val) {
        	$cols .= "`$col`";
        	$vals .= "'$val'";
        	if(count($inp) != $k){
        		$cols .= ', ';
        		$vals .= ', ';
        	}
        	$k++;
        }
        $cols .= ')';
        $vals .= ')';
        $qry = "INSERT INTO $tablename $cols VALUES $vals";
        $result = $this->conn->query($qry);
        if ($result) {
        	return $this->conn->insert_id;
        }else
        	return 0;
    }

    public function update($tablename, $inp, $wh) {
        if(!is_array($inp) || !is_array($wh))
            return 0;
        $set = $where = '';$k = 1;
        foreach ($inp as $col => $val) {
            $set .= "`$col` = '$val'";
            if(count($inp) != $k)
                $set .= ', ';
            $k++;
        }
        $k = 1;
        foreach ($wh as $col => $val) {
            $where .= "`$col` = '$val'";
            if(count($wh) != $k)
                $where .= ', ';
            $k++;
        }
        $qry = "UPDATE $tablename SET $set WHERE $where";
        $result = $this->conn->query($qry);
        if ($result) {
            return $result;
        }else
            return 0;
    }

    public function remove($tablename, $wh) {
        if(!is_array($wh))
            return 0;
        $where = '';$k = 1;
        foreach ($wh as $col => $val) {
            $where .= "`$col` = '$val'";
            if(count($wh) != $k)
                $where .= ', ';
            $k++;
        }
        $qry = "DELETE FROM $tablename WHERE $where";
        $result = $this->conn->query($qry);
        if ($result) {
            return $result;
        }else
            return 0;
    }
}

?>