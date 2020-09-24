<?php

    namespace App\Models\Base;

    use App\Globals;
    use PDO;

    class BaseModel {

        protected PDO $db;
        protected string $table;

        public function __construct(string $table) {

            $this->db = new PDO("mysql:host=" . Globals::DB_HOST . ";dbname=" . Globals::DB_NAME, Globals::DB_USER, Globals::DB_PASS);
            $this->table = $table;
        }

        /**
         * 
         * Returns selected model Type
         *
         * @param string $name The name of the class to load
         * @return BaseModel Returns BaseModel type Object
         */
        public static function loadModel(string $name) : BaseModel {

            require_once("application/models/" . $name . ".php");
            $classn = "App\Models\\" . $name;
            
            return new $classn();
        }

        /**
         * 
         * Executes INSERT query
         *
         * @param array $data Formatted "key" => value
         * @return string Last insert ID
         */
        public function insertData(array $data) : string {

            $result         = null;
            $columns        = array();
            $values         = array();
            $questionMarks  = array();

            foreach($data as $key => $value) {

                $columns[]          = $key;
                $values[]           = $value; 
                $questionMarks[]    = "?";               
            }

                $columns        = implode(", ", $columns);
                $questionMarks  = implode(", ", $questionMarks); 

                $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$questionMarks});";
                $sth = $this->db->prepare($sql);
            
                if($sth->execute($values)) $result = $this->db->lastInsertId();

            return $result;
        }

        /**
         * 
         * Executes UPDATE query
         *
         * @param array $data Formatted "key" => value
         * @return boolean Result from the query execution
         */
        public function editData(array $data) : bool {

            $result     = false;
            $columns    = array();
            $values     = array();

            if(isset($data['id'])) {

                $idRow = $data['id'];

                foreach($data as $key => $value) {

                    if($key != "id") {

                        $columns[] = $key . " = ?";
                        $values[]  = $value;
                    }               
                }

                $columns = implode(", ", $columns);

                $sql     = "UPDATE {$this->table} SET {$columns} WHERE id={$idRow};";
                $sth     = $this->db->prepare($sql);
                
                $result  = $sth->execute($values);
            }

            return $result;
        }

        /**
         * 
         * Executes DELETE query
         *
         * @param int $id ID of the selected row
         * @return boolean Result from the query execution
         */
        public function deleteData(int $id) : bool {

            $result  = false;

            $sql     = "DELETE FROM {$this->table} WHERE id = ?;";
            $sth     = $this->db->prepare($sql);
                
            $result  = $sth->execute(array($id));

            return $result;
        }

        /**
         * 
         * Executes SELECT query
         *
         * @param BaseModel $model Class for modeling result
         * @param array $ids List of ID to select
         * @return array Result from the query execution
         */
        public function selectData(BaseModel $model, array $ids = array()) : array {

            $result  = array();

            $sql = "SELECT * FROM {$this->table}";
            if(count($ids) > 0)  $sql .= " WHERE id IN (" . implode($ids) . ")";

            $sth = $this->db->prepare($sql);
            $sth->execute();

            while($r = $sth->fetchObject(get_class($model)))
                $result[] = $r;

            return $result;
        }

        /**
         * 
         * Executes SELECT query to search rows
         *
         * @param BaseModel $model Class for modeling result
         * @param boolean $strict Search mode
         * @param array $fields List of fields: array('field' => field, 'value' => value)
         * @return array Result from the query execution
         */
        public function searchData(BaseModel $model, bool $strict = true, array ...$fields) : array {

            $result     = array();
            $filters    = array();

            foreach($fields as $field) $filters[] = $strict ? "{$field['field']} = '{$field['value']}'" : "{$field['field']} LIKE '%{$field['value']}%'";

            $sql = "SELECT * FROM {$this->table} WHERE " . implode(" AND ", $filters);

            $sth = $this->db->prepare($sql);
            $sth->execute();

            while($r = $sth->fetchObject(get_class($model)))
                $result[] = $r;

            return $result;
        }

        /**
         * 
         * Format Data for BaseModel::searchData()
         *
         * @param string $field Field name in DB
         * @param string $value Value of the field
         * @return array The formatted array
         */
        public function formatData(string $field, string $value) : array {

            return array("field" => $field, "value" => $value);
        }
    }
?>