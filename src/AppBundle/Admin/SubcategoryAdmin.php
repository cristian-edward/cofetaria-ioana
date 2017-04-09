<?php
/**
 * Created by PhpStorm.
 * User: vali
 * Date: 03.01.2017
 * Time: 17:42
 */

namespace AppBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class SubcategoryAdmin extends AbstractAdmin
{
    //    create route for caregory
    protected $baseRouteName = 'admin-subcategory';
    protected $baseRoutePattern = 'admin-subcategory';
    protected $translationDomain = 'SonataPageBundle';


    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Subcategory description', ['class' => 'col-md-8'])
                ->add('name', null, [
                    'label' => 'Name of subcategory'
                ])
                ->add('category')
                ->add('link')
            ->end()
            ->with('Photo', ['class' => 'col-md-4'])
                ->add('picture', 'entity', [
                    'class' => 'AppBundle\Entity\Admin\Picture',
                    'query_builder' => function (EntityRepository $entityRepository){
                        return $entityRepository->createQueryBuilder('s')
                            ->where('s.filter = :filter')
                            ->setParameter('filter', 'frontEnd_menu');
                    },
                    'multiple' => true,
                    'expanded' => false,
                    'by_reference' => false,
                ])
            ->end();
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('category')
            ->add('link');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
            ->addIdentifier('category')
            ->addIdentifier('link')
            // You may also specify the actions you want to be displayed in the list
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name')
            ->add('category')
            ->add('picture', 'collection', [
                'template' => 'AppBundle:Admin:list_image.html.twig',
            ])
            ->add('link');

    }




}