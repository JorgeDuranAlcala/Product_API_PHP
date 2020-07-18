<?php 

    include_once("utils/Request.php");

    class Router {

        private $request;
        private $allowedHttpMethods = array(
            "GET",
            "POST"
        );
        private $middlewareStack = [];

        public function __construct(Request $req) {
            $this->request = $req;
        }

        public function __call($name, $args)
        {
            # code...

            list($route, $method) = $args;
            print("\n");
            if(count($args) > 2) {
                array_push($this->middlewareStack, $args[count($args) - 1]);
            }
            
            
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
            //print_r($methodDictionary);
            $formatedRoute =  $this->formatRoute($this->request->requestUri);
            preg_match_all("/\?[a-z]+\=\w+/", $formatedRoute, $matches);
            $formatedRoute = str_replace($matches[0], "", $formatedRoute);

            $method = $methodDictionary[$formatedRoute];
            
            if(is_null($method)) {
                $this->defaultRequestHandler();
            }

            //echo call_user_func_array($method, [$this->request]);
            if(count($this->middlewareStack)) {
                echo call_user_func_array($method, [$this->request, $this->middlewareStack[0]]);
            } else {
                echo call_user_func_array($method, [$this->request]);
            }
        }

        function __destruct() 
        {
            //print_r($this->middlewareStack[0]);
            $this->resolve();
        }


    }


?>