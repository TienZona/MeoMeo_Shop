<?php

    class size {
        private $size;

        function __construct( $size){
            $this->size = $size;
        }

        function getSize(){
            return $this->size;
        }
        function setSize($size){
            $this->size = $size;
        }
    }

    function getAllSize(){
        $sql = "select * from `size`";
        return pdo_query($sql);
    }