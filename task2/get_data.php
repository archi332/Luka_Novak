<?php

class get_data
{
    /**
     * @var string
     */
    public $server;
    public $url;


    public function __construct($server)
    {
        $this->setServer($server);
    }

    /**
     * @return void
     */
    public function Manipulation_file()
    {
        $file_name = 'ip.txt';
        $string = $this->string($this->getServer());
        $string_short = $this->string_short($this->getServer());
        $ip = $this->getIP($this->getServer());


        $file_array = file($file_name);
        $key = $this->search($file_array, $ip);

        if (file_exists($file_name) && is_writable($file_name)) {

            if (is_numeric($key)) {
                $file = fopen($file_name, 'w+');
                $file_array[$key] = trim($file_array[$key]) . $string_short;

                foreach ($file_array as $value) {
                    fwrite($file, $value);
                }
            } else {
                $file = fopen($file_name, 'a+');
                fwrite($file, "\n$string");
            }

        } else {
            $file = fopen($file_name, 'a+');
            chmod("$file_name", 0777);
            fwrite($file, "\n$string");
        }

        fclose($file);

    }

    /**
     * @param $server
     * @return string
     */
    public function string($server)
    {
        $ip_client = $server['REMOTE_ADDR'];       //  ip address of client
        $cur_url = $this->getUrl($server);       //  URL of current page
        $cur_time = date('H-i-s');      //  current time
        $all = "$ip_client $cur_url $cur_time ";
        return $all;
    }

    /**
     * @param $server
     * @return string
     */
    public function string_short($server)
    {
        $cur_url = $this->getUrl($server);       //  URL of current page
        $cur_time = date('H-i-s');      //  current time
        $all = " $cur_url $cur_time ";
        return $all;
    }

    /**
     * @param $server
     * @return mixed
     */
    public function getIP($server)
    {
        $ip = $server['REMOTE_ADDR'];
        return $ip;
    }

    /**
     * @param $array_file
     * @param $ip
     * @return bool false || $key int
     */
    function search($array_file, $ip)
    {
        foreach ($array_file as $key => $value) {
            if (strstr($value, $ip)) {
                return $key;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @return mixed $site_url
     */
    function getUrl($server)
    {
        $url = 'http://';
        $url .= $server['SERVER_NAME'];
        $url .= $server['REQUEST_URI'];
        return $url;
    }

}