<?php
/**
 * Created by PhpStorm.
 * User: vali
 * Date: 03.12.2016
 * Time: 14:41
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class WeightAdmin extends AbstractAdmin
{
    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('weight');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('weight');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('weight');
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('weight');

    }
}