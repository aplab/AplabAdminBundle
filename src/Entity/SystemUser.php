<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 31.08.2018
 * Time: 22:27
 */

namespace Aplab\AplabAdminBundle\Entity;


use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SystemUser
 * @package Aplab\AplabAdminBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="system_user")
 */
class SystemUser implements UserInterface
{
    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     *
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * @return string|void
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * @return null|string|void
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @param string $username
     * @return SystemUser
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint", options={"unsigned"=true})
     */
    private $id;
}