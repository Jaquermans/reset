<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    final class requisitions extends abstractEndpoint
    {
        public function __construct(Request $request)
        {
            parent::__construct($request);
            $this->searchFields = array('id','quotation','approve1','approve2','approve3');
            $this->updateFields = array('quotation','approve1','approve2','approve3');
            $this->searchTable = 'requisitions';
            $this->insertFields = array('quotation','crteDate');
        }

        protected function insertValues()
        {
            return array($this->getParams['quotation'],$this->time);
        }

        protected function updateValues()
        {
            return array($this->getParams['quotation'],$this->getParams['approve1'],
                         $this->getParams['approve2'],$this->getParams['approve3']);
        }
    }
