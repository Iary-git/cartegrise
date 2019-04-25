<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\TypeDemande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demarche', EntityType::class, array(
               'class' => TypeDemande::class,
               'choice_label' => 'nom',
               'data'=>$options['defaultType'],
           ))
            ->add('codePostal', null, ['label' => 'Département'])
            ->add('immatriculation', null, ['label' => 'Immatriculation'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);

        $resolver->setRequired(array('defaultType'));
    }
}
