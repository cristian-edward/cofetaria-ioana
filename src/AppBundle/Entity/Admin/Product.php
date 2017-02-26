<?php

namespace AppBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Product
 *
 * @ORM\Table(name="admin_product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Admin\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=150)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text")
     */
    private $longDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Weight")
     * @ORM\JoinColumn(name="weight_id", referencedColumnName="id")
     */
    private $weightId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Picture")
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */
    private $pictureId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     * @Assert\DateTime()
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     * @Assert\DateTime()
     */
    private $updateAt;


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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Product
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     *
     * @return Product
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
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
     * Set categoryId
     *
     * @param \AppBundle\Entity\Admin\Category $categoryId
     *
     * @return Product
     */
    public function setCategoryId(\AppBundle\Entity\Admin\Category $categoryId = null)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @ORM\PrePersist()
     *
     * @return Product
     */
    public function setCreateAt()
    {
        $this->createAt = new \DateTime();

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     * @return Product
     */
    public function setUpdateAt()
    {
        $this->updateAt = new \DateTime();

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
    

    /**
     * Set weightId
     *
     * @param \AppBundle\Entity\Admin\Weight $weightId
     *
     * @return Product
     */
    public function setWeightId(\AppBundle\Entity\Admin\Weight $weightId = null)
    {
        $this->weightId = $weightId;

        return $this;
    }

    /**
     * Get weightId
     *
     * @return \AppBundle\Entity\Admin\Weight
     */
    public function getWeightId()
    {
        return $this->weightId;
    }

    /**
     * Set pictureId
     *
     * @param \AppBundle\Entity\Admin\Picture $picture
     *
     * @return $this
     */
    public function setPictureId(\AppBundle\Entity\Admin\Picture $picture = null)
    {
        $this->pictureId = $picture;

        return $this;
    }


    /**
     * Get pictureId
     *
     * @return \AppBundle\Entity\Admin\Picture
     */
    public function getPictureId()
    {
        return $this->pictureId;
    }


}
