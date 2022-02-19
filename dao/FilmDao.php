<?php

interface FilmDao
{
    function insert(Film $film):bool;

    function findByName($name);

    function filterByYear($year);

    function findAll();

    function update($filmName, Film $film);

    function delete($filmName);

}