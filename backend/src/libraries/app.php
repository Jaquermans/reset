<?php
    declare(strict_types=1);
    namespace reset;
    use reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class app
    {
        private $app;

        private $container;

        public function __construct()
        {
            date_default_timezone_set('America/Ojinaga');
            $this->app = new \Slim\App(['settings' => $this->initialSettings()]);//Starting Slim App
            $this->setContainer();
            $this->setEndPoints();
            $this->setRoutes();
        }

        private function initialSettings()
        {
            $config['displayErrorDetails'] = TRUE;
            $config['addContentLengthHeader'] = FALSE;
            return $config;
        }

        private function setContainer()
        {
            $this->container = $this->app->getContainer();//Creating a Container Variable
            $this->container['logger'] = function($c) {//Monolog PHP Logger
                $logger = new \Monolog\Logger('reset_app_logger');
                $file_handler = new \Monolog\Handler\StreamHandler(__DIR__.'/../../../logs/app.log');
                $logger->pushHandler($file_handler);
                return $logger;
            };
        }

        private function setEndPoints()
        {
            $this->container['quotations'] = function($c) {
                return new endpoints\quotations($c->request);
            };
            $this->container['requisitions'] = function($c) {
                return new endpoints\requisitions($c->request);
            };
        }

        private function setRoutes()
        {
            $this->app->map(['GET','POST'],'/{endpoint}[/{params:.*}]', function (Request $request, Response $response) {
                $endpoint = $request->getAttribute('endpoint');
                if($this->has($endpoint)) {
                    list($status,$data) = $this->$endpoint->processReq();
                } else{
                    $status = 400; $data = 'Invalid Request';
                }

                $newResponse = $response->withHeader('Content-type', 'application/json');
                $newResponse = $response->withJson($data,$status);
                return $newResponse;
            });
        }

        public function bootstrap()
        {
            return $this->app;
        }
    }
