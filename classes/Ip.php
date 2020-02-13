    <?php
    $fielpath = realpath(dirname(__FILE__));

    include_once $fielpath.'/../lib/database.php';
    include_once $fielpath.'/../helpers/format.php';

    class Ip{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database;
            $this->fm = new Format;
        }

    function get_ip_address(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }


    }

?> 

