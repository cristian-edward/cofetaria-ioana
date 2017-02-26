<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\HttpFoundation\Request;

class PictureAdmin extends AbstractAdmin
{
    protected $translationDomain = 'SonataPageBundle';

    /**
     * @param FormMapper $formMapper
     */
    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tip')
            ->add('name')
            ->add('file', 'file')
            ->add('seoLink')
            ->add('isUsed')
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tip')
            ->add('name')
            ->add('seoLink')
            ->add('isUsed')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    // Fields to be lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tip')
            ->add('name')
            ->add('seoLink')
            ->add('isUsed')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }



    /**
     * @param ShowMapper $showMapper
     */
    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('tip')
            ->add('name')
            ->add('path', null, [
                'template' => 'AppBundle:Admin:list_image.html.twig',
                'label' => false
            ])
            ->add('seoLink')
            ->add('isUsed')
        ;
    }
}
