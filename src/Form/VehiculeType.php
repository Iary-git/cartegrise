<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cgpresent')
            ->add('immatriculation', TextType::class, array('label' => 'label.immatriculation'))
            ->add('vin', TextType::class, array('label' => 'label.vin'))
            ->add('numformule', TextType::class, array('label' => 'label.numformule'))
            ->add('datecg', DateType::class, array(
                'label'=> 'label.datecg',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                ))
            ->add('vehiculeAncientitulaire')
            ->add('vehiculeCartegrise')
            ->add('vehiculeDemande')
            ->add('vehiculeClient')
            ->add('client')
            ->add('infosup')
            ->add('Titulaire')
            ->add('demande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
