<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductAdmin extends AbstractAdmin
{
    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Product')
                ->add('title')
                ->add('shortDescription')
                ->add('longDescription')
                ->add('alt')
                ->add('weightId', null, [ 'label' => 'Weight' ])
                ->add('categoryId', null, [
                    'label' => 'Category'
                ])
                ->add('active')
            ->end()
            ->with('Photo')
                ->add('name')
                ->add('file', FileType::class, [
                    'label' => 'Photo',
                    'required' => 'true'
                ])
                ->add('isUsed')
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('shortDescription')
            ->add('longDescription')
            ->add('alt')
            ->add('weightId')
            ->add('active')
            ->add('name')
            ->add('isUsed')
                       ;
    }

    // Fields to be lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->addIdentifier('shortDescription')
            ->add('alt')
            ->add('weightId')
            ->add('active')
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('categoryId', null, ['label' => 'Category'])
            ->add('shortDescription')
            ->add('longDescription')
            ->add('alt')
            ->add('weightId', null, [ 'label' => 'Weight' ])
            ->add('active')
            ->add('name')
            ->add('path', null, [
                'template' => 'AppBundle:Admin:list_image.html.twig',
                'label' => 'Picture'
            ])
            ->add('isUsed')

          # ->add('slug')
           #->add('author')
       ;
    }
}
