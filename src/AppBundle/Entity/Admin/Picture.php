<?php

namespace AppBundle\Entity\Admin;

use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Picture
 *
 * @ORM\Table(name="entity_admin_picture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Admin\PictureRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Picture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $temp;

    /**
     * @ORM\Column(name="tip", type="string", length=255)
     *
     */
    private $tip;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_link", type="string", length=100, unique=true)
     */
    private $seoLink;

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
     * @ORM\Column(name="is_used", type="boolean", nullable=true)
     */
    private $isUsed;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Admin\Product", mappedBy="pictureId", cascade={"persist"})
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTip()
    {
        return $this->tip;
    }

    /**
     * @param mixed $tip
     */
    public function setTip($tip)
    {
        $this->tip = $tip;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Picture
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
     * Set path
     *
     * @param string $path
     *
     * @return Picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set seoLink
     *
     * @param string $seoLink
     *
     * @return Picture
     */
    public function setSeoLink($seoLink)
    {
        $this->seoLink = $seoLink;

        return $this;
    }

    /**
     * Get seoLink
     *
     * @return string
     */
    public function getSeoLink()
    {
        return $this->seoLink;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Picture
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
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set isUsed
     *
     * @param boolean $isUsed
     *
     * @return Picture
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;

        return $this;
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

    /**
     * Get isUsed
     *
     * @return bool
     */
    public function isIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @ORM\PrePersist()
     * @return Picture
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
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     * @return Picture
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
     * Add picture
     *
     * @param \AppBundle\Entity\Admin\Product mixed $product
     *
     * @return picture
     */
    public function addProduct(\AppBundle\Entity\Admin\Product $product)
    {
        $product->setPictureId($this);

        $this->product->add($product);
    }

    /**
     * Remove subcategory
     *
     * @param \AppBundle\Entity\Admin\Subcategory $subcategory
     */
    public function removeProduct(\AppBundle\Entity\Admin\Product $product)
    {
        $this->product->removeElement($product);
    }
}

