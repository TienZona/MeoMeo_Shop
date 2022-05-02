<?php

    class notify{
        private $id_user;
        private $title;
        private $content;
        private $image;

        function __construct($id_user, $title, $content, $image){
            $this->id_user = $id_user;
            $this->title = $title;
            $this->content = $content;
            $this->image = $image;
        }

        function getId_user(){
            return $this->id_user;
        }

        function setId_user($id_user){
            $this->id_user = $id_user;
        }

        function getTitle(){
            return $this->title;
        }
        
        function setTitle($title){
            $this->title = $title;
        }

        function getContent(){
            return $this->content;
        }
        
        function setContent($content){
            $this->content = $content;
        }

        function getImage(){
            return $this->image;
        }
        
        function setImage($image){
            $this->image = $image;
        }
    }

    function createNotify($id_user, $title, $content, $image){
       $sql = "insert into `notify`(id_user, title, content, image) values($id_user, '$title', '$content', '$image')";
       pdo_execute($sql);
    }

    function getNotifyById_user($id_user){
        $sql = "select * from `notify` where `id_user`=$id_user";
        return pdo_query($sql);
    }    

    function getNotifyLimit($id_user, $number){
        $sql = "select * from `notify` where `id_user`=$id_user order by `created_at` desc limit $number";
        return pdo_query($sql);
    }

    function watchNotify($id){
        $sql = "update `notify` set `watched`=1 where `id_notify`=$id";
        pdo_execute($sql);
    }