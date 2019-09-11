<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class CommandeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->add('ceerLe', DateType::class,[
            'label' => 'créer le:',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd-MM-yyyy',
            'disabled' => true,
            'attr' => ['class' => 'js-datepicker', 'placeholder' => 'dd/mm/yyyy'],
        ])
        ->add('demarche.nom', TextType::class,[
            'disabled' => true,
        ])
        ->add('codePostal', TextType::class,[
            'disabled' => true,
        ])
        ->add('immatriculation', TextType::class,[
            'disabled' => true,
        ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('id')
        ->add('demarche.nom')
        ->add('codePostal')
        ->add('immatriculation');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('id')
        ->addIdentifier('demarche.nom')
        ->addIdentifier('immatriculation')
        ->addIdentifier('status')
        ->addIdentifier('codePostal')
        ;
    }
}