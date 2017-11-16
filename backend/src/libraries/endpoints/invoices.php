<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    final class invoices extends abstractEndpoint
    {
        public function __construct(Request $request)
        {
            parent::__construct($request);
            $this->searchFields = array('id','po','approve1','approve2');
            $this->updateFields = array('po','approve1','approve2');
            $this->searchTable = 'invoices';
            $this->insertFields = array('po');
        }

        protected function insertValues()
        {
            return array($this->getParams['po']);
        }

        protected function updateValues()
        {
            return array($this->getParams['po'],$this->getParams['approve1'],
                         $this->getParams['approve2']);
        }
    }
