<?php
/**
 * Created by PhpStorm.
 * User: vali
 * Date: 03.01.2017
 * Time: 17:42
 */

namespace AppBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Proxies\__CG__\AppBundle\Entity\Admin\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SubcategoryAdmin extends AbstractAdmin
{
    //    create route for caregory
    protected $baseRouteName = 'admin-subcategory';
    protected $baseRoutePattern = 'admin-subcategory';

    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', null, [
                        'label' => 'Name of subcategory'
                    ])
                   ->add('category', null, [
                       'class' => 'AppBundle:Admin\Category',
                       'mapped' => false,
                       'error_mapping' => [
                           '.' => 'city',
                       ]
                   ])
                   ->add('link');
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
            ->addIdentifier('link');
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('name')
            ->add('category')
            ->add('link');

    }
}