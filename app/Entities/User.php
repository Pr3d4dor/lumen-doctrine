<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\Organisation;
use LaravelDoctrine\ACL\Mappings as ACL;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPassword;
use LaravelDoctrine\ACL\Contracts\Permission;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionContract;
use LaravelDoctrine\ACL\Permissions\HasPermissions as HasPermissions;
use LaravelDoctrine\ACL\Contracts\Role as HasRoleContract;
use LaravelDoctrine\ACL\Roles\HasRoles as HasRoles;
use LaravelDoctrine\ACL\Contracts\BelongsToOrganisations as BelongToOrganisations;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements AuthenticatableContract, CanResetPasswordContract, HasPermissionContract, HasRoleContract, BelongToOrganisations
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable,
        CanResetPassword,
        HasPermissions,
        HasRoles;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ACL\HasPermissions
     */
    protected $permissions;

    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ACL\BelongsToOrganisations
     * @var Organisation[]
     */
    protected $organisations;

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return ArrayCollection|HasRoleContract[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Organisation[]
     */
    public function getOrganisations()
    {
        return $this->organisations;
    }

    /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }
}