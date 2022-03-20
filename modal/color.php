<?php

    class color{
        private $color;

        function __construct( $color){
            $this->color = $color;
        }

        function getColor(){
            return $this->color;
        }
        function setColor($color){
            $this->color = $color;
        }
    }

    function getAllColor(){
        $sql = "select * from `color`";
        return pdo_query($sql);
    }
