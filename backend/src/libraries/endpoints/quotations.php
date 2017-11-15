<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    final class quotations extends abstractEndpoint
    {
        public function __construct(Request $request)
        {
            parent::__construct($request);
            $this->searchFields = array('id','customer','part','qty','cost','total','date');
            $this->searchTable = 'quotations';
            $this->insertFields = array('customer','part','qty','cost','total','date');
        }

        protected function insertValues()
        {
            return array('\''.$this->getParams['customer'].'\'','\''.$this->getParams['part'].'\'',
                         $this->getParams['qty'],$this->getParams['cost'],
                         $this->getParams['total'],'\''.$this->getParams['date'].'\'');
        }
    }
