<?php
    declare(strict_types=1);
    class config {
        private array $config;

        public function __construct(string $config_path = "/config.php") {
            require_once(__DIR__."/../..".$config_path);
            $this->config = $global_config;
            unset($global_config);
        }

        public function get(string $key):array|string {
            if(strpos($key, ".") !== FALSE) {
                $keys = explode(".", $key);
                $arr = $this->config;
                $ret = "";
                foreach($keys as $keyn) {
                    if(gettype($arr[$keyn]) === "array") {
                        $arr = $this->config[$keyn];
                    } else {
                        $ret = $arr[$keyn];
                    }
                }
                return $ret;
            }
            return $this->config[$key];
        }

        public function get_all():array {
            return $this->config;
        }
    }
