<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;
/**
* Admin User class for login
*/
class UserAdmin extends AbstractAdmin
{
    protected $translationDomain = 'SonataPageBundle';

	 protected function configureFormFields(FormMapper $formMapper)
    {
    	#These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    	 // Fields to be shown on create/edit forms
    	$formMapper->add('username')
    			   ->add('email')
    			   ->add('password')
    			   ->add('roles', 'choice', [
    			   		'choices' => [
    			   			'ROLE_ADMIN' 		=> 'Admin',
    			   			'ROLE_SUPER_ADMIN' 	=> 'Api User'
    			   		],
    			   		'expanded' => false,
	                    'multiple' => true,
	                    'required' => true
    			   	])
    			   ->add('enabled', null, [
	    			   	'required' => true, 
	    			   	'label' => 'Enabled user'
    			   	]);
         
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        #This method configures the filters, used to filter and sort the list of models;
        $datagridMapper->add('username')
	    			   ->add('email')
        				;
    }


     // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
    	#Here you specify which fields are shown when all models are listed (the addIdentifier() method means that this field will link to the show/edit page of this particular model).
        $listMapper->addIdentifier('username')
    			   ->addIdentifier('email')
    			   ->add('roles')
    			   ->add('enabled')
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
    /*protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           ->addIdentifier('title')
           ->addIdentifier('category.name')
          # ->add('slug')
           #->add('author')
       ;
    }*/
}