<?php

namespace AppBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Subcategory
 *
 * @ORM\Table(name="admin_subcategory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Admin\SubcategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Subcategory
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
     * @ORM\Column(name="name", type="string", length=35)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=35)
     */
    protected $link;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Category", inversedBy="subcategory", cascade={"persist"})
     */
    protected $category;

    /**
     * @var datetime
     *
     * @ORM\Column(name="create_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $createAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="update_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $updateAt;

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
     * @return Subcategory
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
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     *  Add category
     *
     * @param \AppBundle\Entity\Admin\Category $category
     *
     * @return Subcategory
     */
    public function setCategory(\AppBundle\Entity\Admin\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return datetime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param datetime $createAt
     *
     * @ORM\PrePersist()
     */
    public function setCreateAt()
    {
        $this->createAt = new \DateTime();
    }

    /**
     * @return datetime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param datetime $updateAt
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdateAt()
    {
        $this->updateAt = new \DateTime();
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Subcategory
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

    public function __toString()
    {
        return $this->name;
    }
}

