<?php

class FilmRepository implements FilmDao
{
    private $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = DBConnection::getDbConnection();
    }

    function insert(Film $film): bool
    {
        $name = $film->getName();
        $year = $film->getConstructionYear();
        $explains = $film->getExplains();
        $picture = $film->getPicture();
        $sql = "INSERT INTO film (film_name,construction_year,explains,picture) 
                VALUE ( '$name','$year','$explains','$picture' )";
        return $this->db->query($sql);
    }

    function findByName($name)
    {
        $query = "select * from film where film_name = '$name'";
        $result =  $this->db->query($query);
        if ($result){
             $jsonResponse =  json_encode($result->fetch_all());
            if ($jsonResponse!='[]'){
                return $jsonResponse;
            }
        }
        return null;
    }

    function filterByYear($year)
    {
        $query = "select * from film where construction_year = $year";
        $result =  $this->db->query($query);
        if ($result){
            $jsonResponse =  json_encode($result->fetch_all());
            if ($jsonResponse!='[]'){
                return $jsonResponse;
            }
        }
        return null;
    }

    function findAll()
    {
        $query = "select * from film ";
        $result =  $this->db->query($query);
        if ($result){
            return json_encode($result->fetch_all());
        }
        return null;
    }

    function update($filmName, Film $film)
    {
        $name = $film->getName();
        $year = $film->getConstructionYear();
        $explains = $film->getExplains();
        $picture = $film->getPicture();
        $query = "UPDATE film
                  SET film_name = '$name' , construction_year = '$year' , explains = '$explains', picture = '$picture'
                   WHERE film_name = '$filmName'";
        return $this->db->query($query);
    }

    function delete($filmName)
    {
        $query = "delete from Film where film_name = '$filmName'";
        return $this->db->query($query);
    }

    function closeConnection()
    {
        $this->db->close();
    }
}