<?php

namespace FilmBundle\Repository;

/**
 * FilmsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * List of films in alphabetical order
     *
     * @return array
     */
    public function findAllFilmByOrder()
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('f')
            ->from('FilmBundle:Films', 'f')
            ->orderBy('f.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Viewing the complete film file
     *
     * @param $id
     * @return mixed
     */
    public function findFullMovie($id)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('f, p, g')
            ->from('FilmBundle:Films', 'f')
            ->innerJoin('f.genre', 'g')
            ->innerJoin('f.production', 'p')
            ->where('f.id=:id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
}
