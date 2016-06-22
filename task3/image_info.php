<?php

class image_info
{

    /** @var string */
    private $get_param;

    /** @var string */
    public $color;

    /** @var  int */
    public $width;

    /** @var  int */
    public $height;


    public function __construct($get)
    {
        $this->setGetParam($get);

    }


    /**
     * @return void
     */
    public function Manipulation_image()
    {

        $raw = file_get_contents($this->getGetParam());     //  reading entire file into a string
        $img = imagecreatefromstring($raw);

        $img_properties = getimagesize($this->getGetParam());       //  get properties file array
        $width = $img_properties['0'];      //  width of image
        $height = $img_properties['1'];     //  height of image




        $this->sort_color_array($width, $height, $img);



        imageDestroy($img);

    }

    /**
     * @param $width
     * @param $height
     * @param $img
     */
    private function sort_color_array($width, $height, $img)
    {
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $col = '#';
                $color = imagecolorat($img, $i, $j);
                $color1 = imagecolorsforindex($img, $color);

                foreach ($color1 as $key => $value) {
                    $hex = dechex($value);
                    $col .= (strlen($hex) == 1) ? '0' . $hex : $hex;
                }
                $color_code = substr($col, 0, 7);
                if (isset($arr_col["$color_code"])) {
                    $arr_col["$color_code"] += 1;
                } else {
                    $arr_col["$color_code"] = 1;
                }
            }
        }

        $this->setHeight($height);
        $this->setWidth($width);
        $this->setColor($arr_col);
    }


    /**
     * @return mixed
     */
    public function getGetParam()
    {
        return $this->get_param;
    }

    /**
     * @param mixed $get_param
     */
    public function setGetParam($get_param)
    {
        $this->get_param = $get_param;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param mixed $color
     */
    public function setColor(array $color)
    {
        ksort($color);
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

}