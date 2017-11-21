<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 19/11/2017
 * Time: 21:30
 */

namespace FilmBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package FilmBundle\Entity
 *
 * @ORM\Entity(repositoryClass="FilmBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}