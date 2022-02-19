<?php

class EmptyFieldException extends Exception
{


    public function __construct()
    {
        parent::__construct(" not successful (no field can be empty) ");
    }
}