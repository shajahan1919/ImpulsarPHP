<?php

    class table{

        private $joins = '';

        private $conditions = '';

        private $table='';

        private $selectors = '*';

        private $order_by = '';

        private $limit = '';

        private $statement = '';

        private $command = '';

        private $conn;

        private $database;

        private $status;

        public function __Construct($table,$database,$connection=null){

            $this->table = $table;

            $this->conn = $connection;

            $this->database = $database;

        }

        public function select($selectors = '*'){

            $this->selectors = $selectors;

        }

        public function orderBy($param=''){

            if($param!=''){
                $this->order_by = " ORDER BY $param"; 
            }

        }


        public function limit($param=''){

            if($param!=''){
                $this->limit = " LIMIT $param";
            }

        }

        public function join(){

            $total_arguements = func_num_args(); // reading total number of arguments

            $args = func_get_args(); // reading arguments values

            if($total_arguements>2){

                $type = isset($args[0]) ? $args[0] : 'join';

                $join_table = isset($args[1]) ? $args[1] : '';

                $join_condition = isset($args[2]) ? $args[2] : '';

            } else{

                $join_table = isset($args[0]) ? $args[0] : '';

                $join_condition = isset($args[1]) ? $args[1] : '';

            }

            
            $join = "$type $join_table ON $join_condition";

            if($this->joins!=''){
				
                $this->joins .= " ".$join;
				
            } else{
				
                $this->joins .= $join;
				
            }
        }

        public function where(){

            $total_arguements = func_num_args(); // reading total number of arguments

            if($total_arguements>0){

                $args = func_get_args(); // reading arguments values

                if($total_arguements==1){ // SINGLE ARGUEMENTED ENDS

                    if(is_array($args[0])){

                        if(!empty($args[0])){

                            $condition = $this->concatArrayCondition($args[0]);

                            if($this->conditions!=''){

                                $this->conditions .= " AND ($condition)";

                            } else{

                                $this->conditions .= $condition;

                            }

                        }

                    } else{

                        if($args[0]!=''){

                            $condition = trim($args[0]);

                            if($this->conditions!=''){

                                $this->conditions .= " AND ($condition)";

                            } else{

                                $this->conditions .= $condition;

                            }

                        }

                    }

                } // SINGLE ARGUEMENTED ENDS

                if($total_arguements==2){ // 2 ARGUEMENTED START

                    if(is_array($args[0]) && (trim(strtoupper($args[1]))=="AND" || trim(strtoupper($args[1]))=="OR")){


                        $condition = $this->concatArrayCondition($args[0]);

                        $bind = trim(strtoupper($args[1]));

                        if($this->conditions!=''){

                            $this->conditions .= " $bind ($condition)";

                        } else{

                            $this->conditions .= $condition;

                        }

                    } else if(trim(strtoupper($args[1]))=="IS NULL" || trim(strtoupper($args[1]))=="IS NOT NULL"){

                        $conditionValue = trim(strtoupper($args[1]));

                        $columnName = trim($args[0]);

                        $bind = 'AND';

                        if($this->conditions!=''){

                            $this->conditions .= " $bind ($columnName $conditionValue)";

                        } else{

                            $this->conditions .= "$columnName $conditionValue";

                        }

                    }  else{

                        $condition = trim($args[0])." = '".trim($args[1])."'";

                        if($this->conditions!=''){

                            $this->conditions .= " AND ($condition)";

                        } else{

                            $this->conditions .= $condition;

                        }
                    }

                } // 2 ARGUEMENTED ENDS

                if($total_arguements==3){  // 3 ARGUEMENTED START

                    if(trim(strtoupper($args[2]))=="AND" || trim(strtoupper($args[2]))=="OR"){

                        $bind = trim(strtoupper($args[2]));

                        if(trim(strtoupper($args[1]))=="IS NULL" || trim(strtoupper($args[1]))=="IS NOT NULL"){

                            $conditionValue = trim(strtoupper($args[1]));

                            $columnName = trim($args[0]);


                            if($this->conditions!=''){
                                $this->conditions .= " $bind ($columnName $conditionValue)";
                            } else{
                                $this->conditions .= "$columnName '$conditionValue'";
                            }

                        } else{

                            $condition = trim($args[0])." = '".trim($args[1])."'";

                            if($this->conditions!=''){

                                $this->conditions .= " $bind ($condition)";
                            } else{

                                $this->conditions .= $condition;
                            }
                        }

                    } else{

                        if(trim(strtoupper($args[1]))=="LIKE" || trim(strtoupper($args[1]))=="NOT LIKE"){

                            $operand = trim(strtoupper($args[1]));

                            $columnName = trim($args[0]);

                            $columnValue = trim($args[2]);

                            if($this->conditions!=''){
                                $this->conditions .= " AND ($columnName $operand '%$columnValue%')";
                            } else{
                                $this->conditions .= " $columnName $operand '%$columnValue%'";
                            }

                        } else{

                            $columnName = trim($args[0]);

                            $columnValue = trim($args[2]);

                            if($this->conditions!=''){

                                $this->conditions .= " AND ($columnName = '$columnValue')";

                            } else{

                                $this->conditions .= " $columnName = '$columnValue'";

                            }
                        }


                    }

                } // 3 ARGUEMENTED ENDS


                if($total_arguements==4){  // 4 ARGUEMENTED START

                    if(trim(strtoupper($args[1]))=="LIKE" || trim(strtoupper($args[1]))=="NOT LIKE"){

                        $operand = trim(strtoupper($args[1]));

                        $filterType = trim(strtoupper($args[3]));

                        $columnName = trim($args[0]);

                        $columnValue = trim($args[2]);

                        if($filterType=='PREFIX'){

                            $conditionData = "$columnValue%";

                        } else if($filterType=='POSTFIX'){

                            $conditionData = "%$columnValue";

                        }else{

                            $conditionData = "%$columnValue%";

                        }

                        if($this->conditions!=''){

                            $this->conditions .= " AND ($columnName $operand '$conditionData')";

                        } else{

                            $this->conditions .= " $columnName $operand '$conditionData'";

                        }


                    } else{

                        $columnName = rim($args[0]);

                        $operand = trim(strtoupper($args[1]));

                        $columnValue = trim($args[2]);

                        $bind = trim(strtoupper($args[3]));

                        if($this->conditions!=''){

                            $this->conditions .= " $bind ($columnName $operand '$columnValue')";

                        } else{

                            $this->conditions .= " $columnName $operand '$columnValue'";

                        }

                    }

                } // 4 ARGUEMENTED ENDS

                if($total_arguements==5 && (trim(strtoupper($args[1]))=="LIKE" || trim(strtoupper($args[1]))=="NOT LIKE")){  // 5 ARGUEMENTED START

                    $columnName = rim($args[0]);

                    $operand = trim(strtoupper($args[1]));

                    $columnValue = trim($args[2]);

                    $filterType = trim(strtoupper($args[3]));

                    $bind = trim(strtoupper($args[4]));

                    if($filterType=='PREFIX'){

                        $conditionData = "$columnValue%";

                    } else if($filterType=='POSTFIX'){

                        $conditionData = "%$columnValue";

                    }else{

                        $conditionData = "%$columnValue%";

                    }

                    if($this->conditions!=''){

                        $this->conditions .= " $bind ($columnName $operand '$conditionData')";

                    } else{

                        $this->conditions .= "$columnName $operand '$conditionData'";

                    }


                } // 5 ARGUEMENTED ENDS


            } // IF ARGUEMENTS CHECK CONDITION END


        }

        public function where_in($column_name){
			
			$total_arguements = func_num_args(); // reading total number of arguments

            $args = func_get_args(); // reading arguments values
			
			$param1 = isset($args[1]) ? $args[1] : null;
			
			$param2 = isset($args[2]) ? $args[2] : null;

            $array = $this->getColumnData($param1,$param2);
			
            $bind = $this->getBind($param1,$param2);

            $bind = trim(strtoupper($bind));

            if(!empty($arrray)){

                $values = "('".implode("','",$array)."')";

                if($this->conditions!=''){

                    $this->conditions .= " $bind ($column_name IN $values)";

                }else{

                    $this->conditions .= "$column_name IN $values";

                }
            }
        }


        public function where_not_in($column_name){
			
			$total_arguements = func_num_args(); // reading total number of arguments

            $args = func_get_args(); // reading arguments values
			
			$param1 = isset($args[1]) ? $args[1] : null;
			
			$param2 = isset($args[2]) ? $args[2] : null;

            $array = $this->getColumnData($param1,$param2);
            $bind = $this->getBind($param1,$param2);

            $bind = trim(strtoupper($bind));

            if(!empty($arrray)){

                $values = "('".implode("','",$array)."')";

                if($this->conditions!=''){

                    $this->conditions .= " $bind $column_name NOT IN $values";

                }else{

                    $this->conditions .= " $column_name NOT IN $values";

                }
            }
        }

        public function where_like_in($column_name){
			
			$total_arguements = func_num_args(); // reading total number of arguments

            $args = func_get_args(); // reading arguments values
			
			$param1 = isset($args[1]) ? $args[1] : null;
			
			$param2 = isset($args[2]) ? $args[2] : null;
			
			$param3 = isset($args[3]) ? $args[3] : null;

            $array = $this->getColumnData($param1,$param2,$param3);

            $bind = $this->getBind($param1,$param2,$param3);

            $filterType = $this->getFilterType($param1,$param2,$param3);

            if(!empty($array) && count($array)>0){

                if($filterType=="PREFIX"){

                    $conditionData = "($column_name LIKE '".implode("%' OR $column_name LIKE '",$array)."%')";

                }else if($filterType=="POSTFIX"){

                    $conditionData = "($column_name LIKE '".implode("%' OR $column_name LIKE '",$array)."%')";

                } else{

                    $conditionData = "(name LIKE '%".implode("%' OR name LIKE '%",$array)."%')";

                }

                if($bind==''){

                    $bind = 'AND';

                }

                if($this->conditions!=''){

                    $this->conditions .= " $bind $conditionData";

                }else{

                    $this->conditions .= $conditionData;

                }


            }



        }

        public function where_not_like_in($column_name){
			
			$total_arguements = func_num_args(); // reading total number of arguments

            $args = func_get_args(); // reading arguments values
			
			$param1 = isset($args[1]) ? $args[1] : null;
			
			$param2 = isset($args[2]) ? $args[2] : null;
			
			$param3 = isset($args[3]) ? $args[3] : null;

            $array = $this->getColumnData($param1,$param2,$param3);

            $bind = $this->getBind($param1,$param2,$param3);

            $filterType = $this->getFilterType($param1,$param2,$param3);

            if(!empty($array) && count($array)>0){

                if($filterType=="PREFIX"){

                    $conditionData = "($column_name NOT LIKE '".implode("%' AND $column_name NOT LIKE '",$array)."%')";

                }else if($filterType=="POSTFIX"){

                    $conditionData = "($column_name NOT LIKE '".implode("%' AND $column_name NOT LIKE '",$array)."%')";

                } else{

                    $conditionData = "(name NOT LIKE '%".implode("%' AND name NOT LIKE '%",$array)."%')";

                }

                if($bind==''){

                    $bind = 'AND';

                }

                if($this->conditions!=''){

                    $this->conditions .= " $bind $conditionData";

                }else{

                    $this->conditions .= $conditionData;

                }


            }
        }

        public function fetch(){

           $this->statement = "SELECT ".$this->selectors." FROM ".$this->table;

            if($this->joins!=''){

                $this->statement .= " ".$this->joins;

            }

            if($this->conditions!=''){

                $this->statement .= " WHERE ".$this->conditions;

            }


            if($this->order_by!=''){

                $this->statement .= $this->order_by;

            }

            if($this->limit!=''){

                $this->statement .=  $this->limit;

            }

            $this->command = 'select';


        }

        public function insert($array){

            if($this->validateDataupdate($array)){

                $columns = array_keys($array);

                $values = array_values($array);

                $this->statement = "INSERT INTO ".$this->table." (".implode(',',$columns).") VALUES('".implode("','",$values)."')";

            }

            $this->command = 'insert';

        }

        public function update($array){

            if($this->validateDataupdate($array)){

                $columns = array_keys($array);

                $values = array_values($array);

                $dataSet = array();

                foreach($array as $key=>$val){

                    $dataSet[] = "$key='$val'";

                }

                $dataToBeUpdate = implode(',',$dataSet);

                $this->statement = "UPDATE ".$this->table;

                if($this->joins!=''){

                    $this->statement .= " ".$this->joins;

                }

                $this->statement .= " SET $dataToBeUpdate";

                if($this->conditions!=''){

                    $this->statement .= " WHERE ".$this->conditions;

                }

            }

            $this->command = 'update';

        }

        public function delete(){

            $this->statement = "DELETE FROM ".$this->table;

            if($this->conditions!=''){

                $this->statement .= " WHERE ".$this->conditions;

            }

            $this->command = 'delete';

        }

        public function statement($statement, $type='execute') {

            $this->statement = $statement;

            $this->command = ($type == 'select' || $type == 'fetch') ? 'select' : 'statement';
        }

        public function concatArrayCondition($array,$bind='AND'){

            $cons = array();

            foreach($array as $key => $value ){

                $cons[] = "$key='$value'";

            }

            return implode(" $bind ",$cons);
        }

        public function getColumnData(){

            $total_arguements = func_num_args(); // reading total number of arguments

            if($total_arguements>0){
                foreach(func_get_args() as $param){
                    if(is_array($param)){
                        return $param;
                    }
                }
                return array();
            } else{
                return array();
            }

        }

        public function getFilterType(){

            $total_arguements = func_num_args(); // reading total number of arguments

            if($total_arguements>0){
                foreach(func_get_args() as $param){
                    if(trim(strtoupper($param))=="LIKE" || trim(strtoupper($param))=="NOT LIKE"){
                        return trim(strtoupper($param));
                    }
                }
                return "";
            } else{
                return "";
            }

        }


        public function getBind(){

            $total_arguements = func_num_args(); // reading total number of arguments

            if($total_arguements>0){

                foreach(func_get_args() as $param){

                    if(trim(strtoupper($param))=="AND" || trim(strtoupper($param))=="OR"){

                        return trim(strtoupper($param));
                    }

                }

                return "AND";

            } else{

                return "AND";

            }

        }

        public function validateDataupdate($array){

            if(is_array($array) && !empty($array)){

                if(array_keys($array) !== range(0, count($array) - 1)) {

                    return true;

                } else{

                    return false;

                }

            } else{

                return false;

            }

        }

        public function getStatement(){

            return $this->statement;

        }

        public function getStatus(){

            if(!isset($this->conn) || $this->command==''){

                return false;

            } else{

                $this->status = $this->database->run($this->statement);

                if($this->command=='insert' || $this->command=='update' || $this->command=='delete' || $this->command=='statement' || $this->command=='execute'){

                    return $this->status;

                } else{

                    $rows = array();

                    while($row = $this->database->fetch($this->status)){

                        $rows[] = $row;

                    }

                    return $rows;

                }

            }

        }

        public function getInsertId(){

            return $this->database->getInsertId();

        }

        public function getCount(){

            $count = 0;

            if($this->status){

                $count = $this->database->countData($this->status);
                
            }

            return $count;
            
        }

        public function getConnectionStatus(){

            if(!isset($this->conn)){

                echo "Not Connected";

            } else{
                echo "Connected";
            }

        }

}



?>
