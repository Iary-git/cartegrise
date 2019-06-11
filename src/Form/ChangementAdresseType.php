<?php

namespace App\Form;

use App\Entity\ChangementAdresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\{AncientitulaireType, NewtitulaireType, AdresseType};

class ChangementAdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acquerreur', NewtitulaireType::class, array('label'=>'label.acquerreur'))
            ->add('ancienAdresse', AdresseType::class, array('label'=>'label.ancienAdresse'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChangementAdresse::class,
        ]);
    }
}
