<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    abstract class abstractEndpoint
    {
        private $logger;
        private $file_handler;

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
            return array(200,'Working');
        }
    }
