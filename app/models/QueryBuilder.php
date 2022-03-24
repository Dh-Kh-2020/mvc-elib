<?php
require_once('DBConn.php');

class QueryBuilder extends DB{
    private $table;
    private $columns = [];
    private $values  = [];
    private $orderBy;
    private $groupBy;
    private $count;
    private $InnerJoin;
    private $leftJoin;
    private $rightJoin;
    private $outerjoin;
    private $limit;
    private $where;
    private $orwhere;

    public $result;

    public function __construct(){
        parent::__construct();
    }

    public function stmInit(){
        $this->table        = $this->table      === null ? '' : $this->table;
        $this->columns      = $this->columns    === []   ? '*' : implode(', ', $this->columns);
        $this->values       = $this->values     === []   ? '*' : implode(', ', $this->values);
        $this->orderBy      = $this->orderBy    === null ? ''  : ' ORDER BY '.$this->orderBy;
        $this->groupBy      = $this->groupBy    === null ? ''  : ' GROUP BY '.$this->groupBy;
        $this->count        = $this->count      === null ? '' : 'count (id) as NumberOfRecords FROM'.$this->table;
        $this->InnerJoin    = $this->InnerJoin  === null ? '' : $this->InnerJoin;
        $this->leftJoin     = $this->leftJoin   === null ? '' : $this->leftJoin;
        $this->rightJoin    = $this->rightJoin  === null ? '' : $this->rightJoin;
        $this->outerjoin    = $this->outerjoin  === null ? '' : $this->outerjoin;
        $this->limit        = $this->limit      === null ? ''  : ' LIMIT '.$this->limit;
        $this->where        = $this->where      === null ? ''  : ' WHERE '.$this->where ;
    }

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function value(...$values){
        $this->values []= $values;
        return $this;
    }

    public function select(...$columns){
        $this->columns []= $columns;
        return $this;
    }

    public function fetch(){
        $this->stmInit();

        $query = "SELECT ". $this->columns . 
                " FROM ". $this->table 
                        . $this->InnerJoin
                        . $this->leftJoin
                        . $this->rightJoin
                        . $this->outerjoin
                        . $this->where 
                        . $this->groupBy
                        . $this->orderBy 
                        . $this->limit;

        $stm = $this->conn->prepare($query);
        echo $query;
        if ($stm->execute())
        {
            $this->result = $stm->fetchAll();
        }
        else
        {
            $this->result = "ERROR: QUERY ISN'T EXCUTED! <br />";
        }
    }

    public function insert($data = array()){
        $t_columns = implode(',', array_keys($data));
        $t_values  = implode("','", $data);

        $query = 'INSERT INTO '.$this->table.' ('.$t_columns.') VALUES ('.$t_values.')';
        $this->conn->prepare($query)->execute();
    }

    public function update(){
        $this->stmInit();

        $query = 'UPDATE ' . $this->table . ' SET ' . $this->values . $this-> where;        
        $this->conn->prepare($query)->execute();
    }

    public function delete(){
        $this->stmInit();

        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $this-> where;
        $this->conn->prepare($query)->execute();
    }

    public function count($columns = null){
        $this->count = $columns;
        $this->stmInit();

        $query = 'SELECT COUNT ('. $this->count .' )'.' FROM '. $this->table . $this->where . $this->orderBy;
        $stm = $this->conn->prepare($query);
        if ($stm->execute())
        {
            $this->result = $stm->fetchAll();
        }
    }

    public function orderBy($order, ...$column_name){
        $this->orderBy = implode(',', $column_name) . " $order";
        return $this;
    }

    public function groupBy(...$column_name){
        $this->groupBy = implode(',', $column_name);
        return $this;
    }

    public function where($column_name, $opreation, $value){
        $condition = $column_name . " " . $opreation . "  '$value'";

        $this->where === null ? $this->where = $condition : $this->where .= ' AND ' . $condition;

        return $this;
    }

    public function orWhere(string $column, string $opreation, $value){
        $condition = $column . " " . $opreation . "  '$value'";
        $this->condition = $this->condition . ' OR ' . $condition;

        return $this;
    }

    public function limit($number, $to = null){
        $toRecord = $to === null ? '' : ",$to";
        $this->limit = "$number".$toRecord;

        return $this;
    }

    public function leftJoin(string $table_name, $FK, $PK){
        $this->leftJoin = " LEFT JOIN  $table_name  ON  $FK  =  $PK";
        return $this;
    }

    public function rightJoin(string $table_name, $FK, $PK){
        $this->rightJoin = " RIGHT JOIN  $table_name  ON  $FK  =  $PK";
        return $this;
    }

    public function InnerJoin(string $table_name, $FK, $PK){
        $this->InnerJoin = " JOIN  $table_name  ON  $FK  =  $PK";
        return $this;
    }
}
?>