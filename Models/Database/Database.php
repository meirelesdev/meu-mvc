<?php

class Database {
    
    private $conn;
    private $schema_cph;
    private $schema_gov;
    private $tableName;
    
    private function __construct( ) {

        $core = Core::getInstance();
        $db = $core->getConfig('db');
        $this->schema_cph = $db['schema_cph'];
        $this->schema_gov = $db['schema_gov'];
       
        $this->conn = pg_connect("host=".$db['host']." dbname=".$db['dbname']." port=".$db['port']." user=".$db['user']." password=".$db['pass']);

        if(!$this->conn){
            echo "Erro: Não foi ppssivel conectar no banco.";
            exit;
        }
    }

    public static function getInstance() {
        static $inst = null;
        if($inst === null){
            $inst = new Database();
        }
        return $inst;
    }

    public function select($rowQuery) {
        if($rowQuery){
            $query = pg_query($this->conn, $rowQuery);

            if ($query) {
                return pg_fetch_all($query);
            } else {
                return null;
            }
        } else {
            echo "Erro na Consulta select enviado: ". $rowQuery;
            exit;
        }
        
    }

    public function insert ($rowQuery) {
        $query = pg_query($this->conn, $rowQuery);
        if ($query ) {
            return true;
        } else {
            return null;
        }
    }

    public function update ($rowQuery){
        $query = pg_query($this->conn, $rowQuery);
        if ($query ) {
            return true;
        } else {
            return null;
        }
    }

    public function delete($rowQuery){
        
        $query = pg_query($this->conn, $rowQuery);

        if($query){
            return true;
        } else {
            return false;
        }
    }
    public function getSchemaCPH(){
        return $this->schema_cph;
    }
    public function getSchemaGOV(){
       
        return $this->schema_gov;
    }

    public function selectComplex($options = []) {
        try {
            $campos = $options['campos'];
            $where = $options['where'];
            $orderby = $options['orderby'];
            $groupby = $options['groupby'];
            $join = $options['join'];
            $schema = $options['schema'];
            
            if($campos == null || $campos == '') {
                $campos = '*';
            }

            if($schema != ''){
                $select = "SELECT ".$campos." FROM ".$schema.".".$this->tableName;
            } else {
                $select = "SELECT ".$campos." FROM ".$this->schema_gov.".".$this->tableName;
            }

            if ($join != '' ){
                $select .= " ".$join;
            }

            if ($where != ''){
                $select .= " WHERE ".$where;
            }

            if ($groupby != ''){
                $select .= " group by ".$groupby;
            }

            if ($orderby != ''){
                $select .= " order by ".$orderby;
            }

            $result = $this->select($select);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

}

?>