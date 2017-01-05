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
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=100)
     */
    private $alt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_used", type="boolean", nullable=true)
     */
    private $isUsed;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    private $file;

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
     * Set src
     *
     * @param string $src
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Product
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {

            //  $this->getFile()->getClientOriginalName() is not clean so first: CLEAN IT!

            $this->setPath($this->getCreateAt()->format('Y-m-d_H-i-s').'_'.$this->getFile()->getClientOriginalName());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->path
        );

        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }


    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'assets/images/uploads/products';
    }



    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @param boolean $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;
    }


    /**
     * Get isUsed
     *
     * @return boolean
     */
    public function getIsUsed()
    {
        return $this->isUsed;
    }
}
