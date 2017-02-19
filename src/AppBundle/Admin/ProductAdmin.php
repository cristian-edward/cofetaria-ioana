<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\HttpFoundation\Request;

class ProductAdmin extends AbstractAdmin
{
    protected $translationDomain = 'SonataPageBundle';

    #These lines configure which fields are displayed on the edit and create actions. The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $request = Request::createFromGlobals()->getBasePath();
            $fullPath = $request.'/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" />';
        }
        #dump($fullPath);
        #die();
        $formMapper
           /* ->tab('Product')*/
                ->with('Description')
                    ->add('title', null,  [], [
                        'translation_domain' => 'SonataPageBundle',
                    ])
                    ->add('shortDescription', null, [], [
                        'translation_domain' => 'SonataPageBundle',
                    ])
                    ->add('longDescription')
                    ->add('alt')
                    ->add('weightId', null, [ 'label' => 'Weight' ])
                    ->add('categoryId', null, [ 'label' => 'Category' ])
                    ->add('active')
                ->end()
           /* ->end()
            ->tab('Photo')*/
                ->with('Photo')
                    ->add('name')
                    ->add('file', 'file',  [],  $fileFieldOptions)
                    ->add('isUsed')
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
            ->add('title', null,  array(
                'translation_domain' => 'SonataPageBundle',
            ))
            ->add('shortDescription')
            ->add('longDescription')
            ->add('alt')
            ->add('weightId', null, [ 'label' => 'Weight' ])
            ->add('active')
            ->add('name')
            ->add('isUsed')
        ;
    }

    // Fields to be lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array(
            'translation_domain' => 'SonataPageBundle',
        ))
            ->addIdentifier('shortDescription')
            ->add('alt')
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
            ->add('title', null, array(
                'translation_domain' => 'SonataPageBundle',
            ))
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
