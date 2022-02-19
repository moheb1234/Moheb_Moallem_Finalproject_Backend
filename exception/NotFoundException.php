<?php

class NotFoundException extends Exception
{


    public function __construct($name)
    {
        parent::__construct('film with name: '.$name.'  not founded');
    }

}