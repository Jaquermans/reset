<?php
    declare(strict_types=1);
    namespace reset\datasources;
    use PDO;

    abstract class abstractSQL
    {
        protected $_db = NULL;

        protected $fields = Array();
        protected $table = NULL;
        protected $whereClause = NULL;

        protected $values = Array();

        public function __construct()
        {
            $this->setLogger();
            $this->setDB();
        }

        private function setLogger()
        {
            $this->logger = new \Monolog\Logger('endpoint_logger');
            $this->file_handler = new \Monolog\Handler\StreamHandler(__DIR__.'/../../../../logs/app.log');
            $this->logger->pushHandler($this->file_handler);
        }

        private function setDB()
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=reset','reset', 'reset1234');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        public function setFields(array $fields)
        {
            $this->fields = $fields;
        }

        public function setTable(string $table)
        {
            $this->table = $table;
        }

        public function setWhereRaw(string $whereClause)
        {
            $this->whereClause = $whereClause;
        }

        public function setValues(array $values)
        {
            $this->values = $values;
        }

        protected function run(string $sql, bool $res = FALSE, bool $fetch = FALSE)
        {
            $results = NULL; $status = 500;
            if($stmt = $this->_db->prepare($sql)){
                $stmt->execute();
                if($res){
                    if($fetch) {
                        $results = $stmt->fetchAll();
                    } else {
                        $results = $stmt->fetch();
                    }
                }
                $stmt->closeCursor();
                $status = 200;
            }
            return array($status,$results);
        }
    }
