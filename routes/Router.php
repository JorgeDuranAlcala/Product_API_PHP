<?php 

    include_once("utils/Request.php");

    class Router {

        private $request;
        private $allowedHttpMethods = array(
            "GET",
            "POST"
        );

        public function __construct(Request $req) {
            $this->request = $req;
        }

        public function __call($name, $args)
        {
            # code...
            
            list($route, $method) = $args;

            if(!in_array(strtoupper($name), $this->allowedHttpMethods)) {
                $this->invalidMethodHandler();
            }

            $this->{strtolower($name)}[$this->formatRoute($route)] = $method;


        }

        private function invalidMethodHandler() 
        {
            header("{$this->request->serverProtocol} 405 method not allowed");
        }

        private function defaultRequestHandler() 
        {
            header("{$this->request->serverProtocol} 404 not found");
        }

        public function formatRoute(string $route)
        {
            # code...
            
            $result = rtrim($route, '/');

            if($result === '') { 
                return '/';
            }
            
            return $result;
        }
        
        private function resolve()
        {
            # code...
            $methodDictionary = $this->{strtolower($this->request->requestMethod)};
            $formatedRoute =  $this->formatRoute($this->request->requestUri);
            preg_match_all("/\?[a-z]+\=\w+/", $formatedRoute, $matches);
            $formatedRoute = str_replace($matches[0], "", $formatedRoute);

            $method = $methodDictionary[$formatedRoute];
            
            if(is_null($method)) {
                $this->defaultRequestHandler();
            }

            echo call_user_func_array($method, [$this->request]);
           
        }

        function __destruct() 
        {
            $this->resolve();
        }


    }


?>