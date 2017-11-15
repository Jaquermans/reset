<?php
    declare(strict_types=1);
    namespace reset\datasources;

    final class updateSQL extends abstractSQL
    {
        public function __construct()
        {
            parent::__construct();
        }

        private function getSetStmt()
        {
            $setStmt = Array();
            foreach ($this->fields as $key=>$val) {
                $setStmt[$key] = $this->fields[$key].'='.$this->values[$key];
            }
            return $setStmt;
        }

        public function execute()
        {
            $sql = 'UPDATE '.$this->table.' SET '.implode(',',$this->getSetStmt()).' ';
            $sql .= ' WHERE ('.$this->whereClause.')';
            $this->logger->addInfo($sql);
            list($status,$mess) = $this->run($sql);
            return array($status,'Record Successfully Updated');
        }
    }
