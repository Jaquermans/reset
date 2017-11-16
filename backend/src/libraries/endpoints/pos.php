<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    final class pos extends abstractEndpoint
    {
        public function __construct(Request $request)
        {
            parent::__construct($request);
            $this->searchFields = array('id','requisition',);
            $this->updateFields = array('requisition');
            $this->searchTable = 'pos';
            $this->insertFields = $this->updateFields;
        }

        protected function insertValues()
        {
            return array($this->getParams['requisition']);
        }

        protected function updateValues()
        {
            return $this->insertValues();
        }
    }
