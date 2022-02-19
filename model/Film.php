<?php

class Film
{
    private $id;
    private $name;
    private $constructionYear;
    private $explains;
    private $picture;

    /**
     * @param $name
     * @param $constructionYear
     * @param $explains
     * @param $picture
     */
    public function __construct($name, $constructionYear, $explains, $picture)
    {
        $this->name = $name;
        $this->constructionYear = $constructionYear;
        $this->explains = $explains;
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getConstructionYear()
    {
        return $this->constructionYear;
    }

    /**
     * @return mixed
     */
    public function getExplains()
    {
        return $this->explains;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

}