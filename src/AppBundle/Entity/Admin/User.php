<?php

namespace AppBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Intl\Locale\Locale;

/**
 * User
 *
 * @ORM\Table(name="admin_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Admin\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", nullable=true)
     */
    protected $locale;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getLocale()
    {
        return $this->locale = "ro";
    }

    /**
     * @param string $lang
     */
    public function setLocale($locale)
    {

        $this->locale = $locale;
    }
}

