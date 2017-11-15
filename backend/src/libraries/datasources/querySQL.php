<?php
    declare(strict_types=1);
    namespace reset\datasources;

    final class querySQL extends abstractSQL
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function execute()
        {
            $sql = 'SELECT '.implode(',',$this->fields).' FROM '.$this->table;
            $sql .= ' WHERE ('.$this->whereClause.')';
            $this->logger->addInfo($sql);
            return $this->run($sql,TRUE,TRUE);
        }
    }
