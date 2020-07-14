<?php
    include_once('models/Request.php');

    use models as md;

    class Request implements md\IRequest
    {

        public function __construct() {
            $this->bootstrapSelf();
        }

        public function bootstrapSelf()
        {
            foreach ($_SERVER as $key => $value) {
                # code...
                $this->{$this->toCamelCase($key)} = $value;
            }
        }

        public function toCamelCase(string $str)
        {
            # code...
            $result = strtolower($str);

            preg_match_all('/_[a-z]/', $result, $matches);

            foreach ($matches[0] as $match) {
                # code...
                $c = str_replace('_', '', strtoupper($match));

                $result = str_replace($match, $c, $result);
            }

            return $result;
        }


        public function getBody() {
            switch ($this->requestMethod) {
                case 'GET':
                    return;
                break;
                
                case 'POST':

                    $body = array();

                    foreach ($_POST as $key => $value) {
                        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                    return $body;

                break;
            }
        }
    }
    

?>