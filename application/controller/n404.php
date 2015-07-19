<?php
class n404 extends Application
{
    function __construct()
    {
        
    }

    function index()
    {
        $this->loadView('404');
    }

}
?>