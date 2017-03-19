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
        if($this->hasParentFieldDescription()) { // this Admin is embedded
            // $getter will be something like 'getlogoImage'
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();

            // get hold of the parent object
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if ($parent) {
                $image = $parent->$getter();
            } else {
                $image = null;
            }
        } else {
            $image = $this->getSubject();
        }

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => true);
        if ($image && ($webPath = $image->getWebPath())) {
            // add a 'help' option containing the preview's img tag
            $fileFieldOptions = array('required' => false);
            $fileFieldOptions['help'] = $webPath;
        }

        $formMapper
            ->add('name')
            ->add('seoLink')
            ->add('filter', 'choice', [
                'choices'                   => [
                    'Filter menu'    => 'frontEnd_menu',
                    'Filter picture' => 'frontEnd_image',
                    'Filter backend' => 'admin_product_image',
                ],
                'placeholder'               => 'Choose a filter',
                'choice_translation_domain' => TRUE,
                'translation_domain'        => 'SonataAdminBundle',
            ])
            ->add('file', 'file', $fileFieldOptions)
            ->add('isUsed');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('seoLink')
            ->add('filter')
            ->add('isUsed');
    }

    /**
     * @param ListMapper $listMapper
     */
    // Fields to be lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('seoLink')
            ->add('filter')
            ->add('isUsed')
            ->add('_action', NULL, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ]);
    }



    /**
     * @param ShowMapper $showMapper
     */
    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('seoLink')
            ->add('filter')
            ->add('path', NULL, [
                'template' => 'AppBundle:Admin:list_image.html.twig',
            ])
            ->add('isUsed');
    }
}
