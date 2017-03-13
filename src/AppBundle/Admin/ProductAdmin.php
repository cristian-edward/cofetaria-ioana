<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Admin\Picture;
use AppBundle\Entity\Admin\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends AbstractAdmin
{
    protected $translationDomain = 'SonataPageBundle';


    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
           /* ->tab('Product')*/
                ->with('Product description', ['class' => 'col-md-8'])
                    ->add('title', null,  [])
                    ->add('shortDescription')
                    ->add('longDescription')
                  #  ->add('alt')
                    ->add('weightId', null, [ 'label' => 'Weight' ])
                    ->add('categoryId', null, [ 'label' => 'Category' ])
                    ->add('active')
                ->end()
           /* ->end()
            ->tab('Photo')*/
                ->with('Photo', ['class' => 'col-md-4'])
                    ->add('picture', 'entity', [
                        'class' => 'AppBundle\Entity\Admin\Picture',
                        'multiple' => true,
                        'expanded' => false,
                        'by_reference' => false,
                    ])
                 #   ->add('file', 'file',  [],  $fileFieldOptions)
                ->end()
           /* ->end()*/
        ;
        //TODO de intrate si vazut cu se face handled pentru imaginea uplodata
//        https://sonata-project.org/bundles/admin/2-3/doc/cookbook/recipe_file_uploads.html


    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null)
            ->add('shortDescription')
            ->add('longDescription')
            ->add('weightId', null, [ 'label' => 'Weight' ])
            ->add('active')
        ;
    }

    // Fields to be lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null)
            ->addIdentifier('shortDescription')
           # ->add('alt')
            ->add('weightId', null, [ 'label' => 'Weight' ])
            ->add('active')
            // You may also specify the actions you want to be displayed in the list
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
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
            ->add('weightId', null, [ 'label' => 'Weight' ])
            ->add('active')
            ->add('picture', 'collection', [
                'template' => 'AppBundle:Admin:list_image.html.twig',
            ])
       ;

    }



}
