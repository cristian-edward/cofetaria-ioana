<?php

namespace AppBundle\Entity\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categories
 *
 * @ORM\Table(name="admin_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Admin\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Admin\Subcategory", mappedBy="category", cascade={"persist"})
     *
     * @return Subcategory
     */
    private $subcategory;

    /**
     * @var datetime
     *
     * @ORM\Column(name="create_at", type="datetime")
     * @Assert\DateTime()
     */
    private $createAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="update_at", type="datetime")
     * @Assert\DateTime()
     */
    private $updateAt;

    public function __construct()
    {
        $this->subcategory = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Add subcategory
     *
     * @param \AppBundle\Entity\Admin\Subcategory mixed $subcategorie
     *
     * @return subcategory
     */
    public function addSubcategory(\AppBundle\Entity\Admin\Subcategory $subcategory)
    {
        $subcategory->setCategory($this);

        $this->subcategory->add($subcategory);
    }

    /**
     * Remove subcategory
     *
     * @param \AppBundle\Entity\Admin\Subcategory $subcategory
     */
    public function removeSubcategory(\AppBundle\Entity\Admin\Subcategory $subcategory)
    {
        $this->subcategory->removeElement($subcategory);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Categories
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Categories
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createAt
     *
     * @param \Datetime $createAt
     * @ORM\PrePersist()
     *
     * @return Categories
     */
    public function setCreateAt()
    {
        $this->createAt = new \DateTime();

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \Datetime $createAt
     *
     * @return Categories
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @return \DateTime $updateAt
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     * @return Categories
     */
    public function setUpdateAt()
    {
        $this->updateAt = new \DateTime();

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \Datetime $updateAt
     *
     * @return Categories
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    public function __toString()
    {
        return $this->name;
    }
}
