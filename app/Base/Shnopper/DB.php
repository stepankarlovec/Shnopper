<?php

namespace Shnopper;

use PDO;

class DB{
    private PDO $pdo;
    // resetable after execution
    private string $query;
    private array $preparedParams;
    private int $numOfPP;
    private array $history;
    private array $selectedColumns;
    private string $table;
    private int $limit;
    private array $where;
    private array $order;

    public function __construct($host, $dbname, $user, $pass, $options, $charset="utf8mb4")
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $this->pdo = new PDO($dsn,$user,$pass);
        foreach (array_values($options) as $key => $option){
            $this->pdo->setAttribute(key($option), array_values($option)[0]);
        }
        $this->query = "";
        $this->preparedParams = [];
        $this->numOfPP = 0;
        $this->history = [];
        $this->selectedColumns = [];
        $this->table = "";
        $this->limit = 0;
        $this->where = [];
        $this->order = [];
    }

    /**
     * @param $name
     */
    public function table($name){
        $this->table = $name;
        return $this;
    }

    public function select($fields){
        $fields = explode(',', $fields);
        foreach($fields as $field){
            array_push($this->selectedColumns, $field);
        }

    }

    public function limit($limit){
        $this->limit = $limit;
    }

    public function where($column, $param, $comparer = "="){
        array_push($this->where, ['col' => $column, 'param' => $param, 'comparer'=> $comparer]);
    }

    public function orderBy($col, $type="ASC"){
     array_push($this->order, ['col' => $col, 'type' => $type]);
    }

    /**
     * fetches all results
     * @return array
     */
    public function fetchAll(){
        $sql = $this->prepareSQL();

        if(count($this->preparedParams)>0) {
            $stmt = $this->pdo->prepare($sql);
            foreach ($this->preparedParams as $param) {
                $stmt->bindParam($param['id'], $param['param'], is_numeric($param['param']) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
        }else{
            $stmt = $this->pdo->query($sql);
        }

        return $stmt->fetchAll();
    }

    /**
     * fetches first result
     * @return mixed
     */
    public function fetch(){
        $sql = $this->prepareSQL();

        if(count($this->preparedParams)>0) {
            $stmt = $this->pdo->prepare($sql);
            foreach ($this->preparedParams as $param) {
                $stmt->bindParam($param['id'], $param['param'], is_numeric($param['param']) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
        }else{
            $stmt = $this->pdo->query($sql);
        }

        return $stmt->fetch();
    }

    /**
     * function which parses the whole class and puts it into single sql string
     * @return string
     */
    private function prepareSQL(): string
    {
        $this->query = "SELECT ";
        if(count($this->selectedColumns)>0){
            foreach ($this->selectedColumns as $key => $column) {
                if($key===count($this->selectedColumns)){
                    $this->query = $this->query . $column . " FROM";
                }else {
                    $this->query = $this->query . $column . ",";
                }
            }
        }else{
            $this->query = $this->query . "* FROM";
        }
        if($this->table){
            $this->query = $this->query . " " . $this->table;
        }
        if(count($this->where)>0){
            $this->query = $this->query . " WHERE ";
            for ($i=0;$i<count($this->where);$i++){
                if($i=0) {
                    $this->query = $this->query . $this->where[$i]['col'] . $this->where[$i]['comparer'] . '?';
                    $this->numOfPP += 1;
                    array_push($this->preparedParams, ['id'=>$this->numOfPP,'param' => $this->where[$i]['param']]);
                }else{
                    $this->query = $this->query . " AND" . $this->where[$i]['col'] . $this->where[$i]['comparer'] . '?';
                    $this->numOfPP += 1;
                    array_push($this->preparedParams, ['id'=>$this->numOfPP,'param' => $this->where[$i]['param']]);
                }
            }
        }
        if(count($this->order)>0){
            $this->query = $this->query . " ORDER BY " . $this->order[0]['col'] . " " . $this->order[0]['type'];
        }
        if($this->limit){
            $this->query = $this->query . " LIMIT " . $this->limit;
        }
        $this->query = $this->query . ";";
        return $this->query;
    }
}