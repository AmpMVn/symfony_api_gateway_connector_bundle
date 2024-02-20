<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\User;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\Group\Group;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;


class User
{

    protected $id;

    protected $email;

    protected $username;

    protected Collection $groups;

    /**
     * @param Collection $groups
     */
    public function setGroups($groups)
    {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->groups = new ArrayCollection($serializer->deserialize(json_encode($groups), Group::class . '[]', 'json'));
    }

    public function addGroup(Group $object): void
    {
        if (!$this->groups->contains($object)) {
            $this->groups[] = $object;
            $this->groups->add($object);
        }
    }

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getGroups(): ArrayCollection|Collection
    {
        return $this->groups;
    }
}
