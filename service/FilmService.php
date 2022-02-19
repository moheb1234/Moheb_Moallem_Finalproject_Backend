<?php

class FilmService
{
    private FilmRepository $filmRepository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->filmRepository = new FilmRepository();
    }


    /**
     * @throws DuplicateValueException
     * @throws EmptyFieldException
     */
    function insert(Film $film): bool
    {
        if (!$this->checkField($film)) {
            throw new EmptyFieldException();
        }
        if ($this->filmRepository->findByName($film->getName()) != null) {
            throw new DuplicateValueException($film->getName());
        }
        return $this->filmRepository->insert($film);
    }

    /**
     * @throws NotFoundException
     */
    function findByName($name)
    {
        if ($this->filmRepository->findByName($name) == null) {
            throw new NotFoundException($name);
        }
        return $this->filmRepository->findByName($name);
    }


    /**
     * @throws NotFoundException
     */
    function filterByYear($year)
    {
        if ($this->filmRepository->filterByYear($year)===null){
            throw new NotFoundException($year);
        }
        return $this->filmRepository->filterByYear($year);
    }

    function findAll()
    {
        return $this->filmRepository->findAll();
    }

    /**
     * @throws EmptyFieldException
     * @throws DuplicateValueException
     * @throws NotFoundException
     */
    function update($filmName, Film $film)
    {
        if (!$this->checkField($film)) {
            throw new EmptyFieldException();
        }
        if ($this->filmRepository->findByName($filmName)==null){
            throw new NotFoundException($filmName);
        }
        if ($filmName != $film->getName() && $this->filmRepository->findByName($film->getName()) != null) {
            throw new DuplicateValueException($filmName);
        }
        return $this->filmRepository->update($filmName, $film);
    }

    /**
     * @throws NotFoundException
     */
    function delete($filmName)
    {
        if ($this->filmRepository->findByName($filmName) == null) {
            throw new NotFoundException($filmName);
        }
        return $this->filmRepository->delete($filmName);
    }

    private function checkField(Film $film): bool
    {
        if ($film->getName() == '' || $film->getConstructionYear() == null
            || $film->getPicture() == '' || $film->getExplains() == '') {
            return false;
        }
        return true;
    }

    function closeConnection()
    {
        $this->filmRepository->closeConnection();
    }
}