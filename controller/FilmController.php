<?php

use http\Message;

class FilmController
{
    private FilmService $filmService;

    public function __construct()
    {
        $this->filmService = new FilmService();
    }

    public function switcher($method, $parameter, $jsonBody)
    {
        if ($method == RequestMethods::get) {
            if ($parameter['name'] != null && $parameter['year'] == null) {
                $this->findByName($parameter);
                return;
            }
            if ($parameter['year'] != null && $parameter['name'] == null) {
                $this->filterByYear($parameter);
                return;
            }
            $this->getAll();

        }
        if ($method == RequestMethods::post) {
            $this->insert($jsonBody);
        }
        if ($method == RequestMethods::put) {
            $this->update($parameter, $jsonBody);
        }
        if ($method == RequestMethods::delete) {
            $this->delete($parameter);
        }
    }


    function insert($jsonFilm)
    {
        $film = new Film($jsonFilm->name, $jsonFilm->constructionYear, $jsonFilm->explains, $jsonFilm->picture);
        try {
            if ($this->filmService->insert($film)) {
                http_response_code(201);
            } else {
                http_response_code(500);
            }
        } catch (DuplicateValueException $e) {
            echo $e->getMessage();
            http_response_code(401);
        } catch (EmptyFieldException $e) {
            echo $e->getMessage();
            http_response_code(400);
        }
        $this->filmService->closeConnection();
    }

    function update($parameter, $jsonFilm)
    {
        $film = new Film($jsonFilm->name, $jsonFilm->constructionYear, $jsonFilm->explains, $jsonFilm->picture);
        $name = $parameter['name'];
        try {
            if ($this->filmService->update($name, $film)) {
                http_response_code(200);
            } else {
                http_response_code(500);
            }
        } catch (DuplicateValueException $e) {
            http_response_code(401);
        } catch (NotFoundException $e) {
            http_response_code(404);
        } catch (EmptyFieldException $e) {
            http_response_code(400);
        }
        $this->filmService->closeConnection();
    }

    function delete($parameter)
    {
        $name = $parameter['name'];
        try {
            if ($this->filmService->delete($name)) {
                http_response_code(200);
            } else {
                http_response_code(500);
            }
        } catch (NotFoundException $e) {
            http_response_code(404);
        }
        $this->filmService->closeConnection();
    }

    function getAll()
    {
        echo $this->filmService->findAll();
        $this->filmService->closeConnection();
        http_response_code(200);
    }

    function findByName($parameter)
    {
        $name = $parameter['name'];
        try {
            echo $this->filmService->findByName($name);
        } catch (NotFoundException $e) {
            echo $e->getMessage();
            http_response_code(404);
        }
        $this->filmService->closeConnection();
    }

    function filterByYear($parameter)
    {
        $year = $parameter['year'];
        try {
            echo $this->filmService->filterByYear($year);
        } catch (NotFoundException $e) {
            http_response_code(404);
        }
        $this->filmService->closeConnection();
    }
}