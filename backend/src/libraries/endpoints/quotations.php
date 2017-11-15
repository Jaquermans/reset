<?php
    declare(strict_types=1);
    namespace reset\endpoints;
    use \Psr\Http\Message\ServerRequestInterface as Request;//Get the http request object

    final class quotations extends abstractEndpoint
    {
        public function __construct(Request $request)
        {
            parent::__construct($request);
        }
    }
