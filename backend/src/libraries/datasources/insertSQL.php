<?php
    declare(strict_types=1);
    namespace reset\datasources;

    final class insertSQL extends abstractSQL
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function execute()
        {
            $sql = 'INSERT INTO '.$this->table.' ('.implode(',',$this->fields).') ';
            $sql .= 'VALUES ('.implode(',',$this->values).');';
            list($status,$mess) = $this->run($sql);
            return array($status,'Record Successfully Inserted');
        }
    }
