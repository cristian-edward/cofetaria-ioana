<?php

namespace AppBundle\Entity\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=150)
     */
    protected $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text")
     */
    protected $longDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Weight")
     * @ORM\JoinColumn(name="weight_id", referencedColumnName="id")
     */
    protected $weightId;
#@ORM\ManyToOne(targetEntity="AppBundle\Entity\Admin\Picture", inversedBy="product", cascade={"persist"})
#* @ORM\JoinColumn(name="product_id", referencedColumnName="id")

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Admin\Picture", mappedBy="product", cascade={"persist"})
     *
     */
    public $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $updateAt;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set pictures
     *
     * @param \AppBundle\Entity\Admin\Picture $picture
     *
     * @return $this
     */
    public function getPicture()
    {
        return $this->picture;
    }


    /**
     * @param Picture $pictures
     */
    public function addPicture(\AppBundle\Entity\Admin\Picture $picture)
    {

        $picture->setProduct($this);

        $this->picture->add($picture);

    }

    /**
     * @param Picture $pictures
     */
    public function removePicture(\AppBundle\Entity\Admin\Picture $picture)
    {
        $this->picture->removeElement($picture);
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






}
