<?php

class DuplicateValueException extends Exception
{


    public function __construct($name)
    {
       parent::__construct($name . "is duplicate");

    }

}