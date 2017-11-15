<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use reset\datasources;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    abstract class abstractEndpoint
    {
        private $logger;
        private $file_handler;

        private $verb = NULL;
        private $args = Array();

        protected $searchFields;
        protected $searchTable;

        public function __construct(Request $request)
        {
            $this->setLogger();
            $this->setReqVars($request);
            $this->setReqType($request);
            $this->getParams = $request->getQueryParams();
            //$this->postParams = $request->getParams();
        }

        private function setLogger()
        {
            $this->logger = new \Monolog\Logger('endpoint_logger');
            $this->file_handler = new \Monolog\Handler\StreamHandler(__DIR__.'/../../../../logs/app.log');
            $this->logger->pushHandler($this->file_handler);
        }

        private function setReqVars(Request $request)
        {
            $this->args=explode('/',rtrim($request->getUri()->getPath(),'/'));
            array_shift($this->args);//This Moves args[0] to the endpoint constant
            if(array_key_exists(0,$this->args) && !is_numeric($this->args[0])){
                $this->verb=array_shift($this->args);
            }
        }

        private function setReqType(Request $request)
        {
            if($request->isGet()){
                $this->reqType = 'get';
            } else if($request->isPost()){
                $this->reqType = 'post';
            }
        }

        public function processReq()
        {
            switch ($this->reqType) {
                case 'get':
                    if ($this->verb==='search' && !array_key_exists(0,$this->args)) {
                        return $this->search();//Execute the Search
                    } elseif ($this->verb==='new' && !array_key_exists(0,$this->args)) {
                        return $this->new();//Execute the Search
                    }
                    break;
            }
            return array(400,'Invalid Request');
        }

        private function search()
        {
            $search = new datasources\querySQL();
            $search->setFields($this->searchFields);
            $search->setTable($this->searchTable);
            $search->setWhereRaw('1');
            return $search->execute();
        }

        private function new()
        {
            $insert = new datasources\insertSQL();
            $insert->setTable($this->searchTable);
            $insert->setFields($this->insertFields);
            $insert->setValues($this->insertValues());
            return $insert->execute();
        }
    }
