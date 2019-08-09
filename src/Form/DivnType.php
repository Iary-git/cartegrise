<?php

namespace App\Form;

use App\Entity\Divn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\NewtitulaireType;
use App\Form\VehiculeNeufType;
use App\Form\CotitulairesType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DivnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acquerreur', NewtitulaireType::class, array('label'=>'label.acquerreur'))
            //->add('vehicule', VehiculeNeufType::class, array('label'=>'label.vehicule.info'))
            ->add('cotitulaire', CollectionType::class, [
                'label' => 'label.cotitulaire',
                'entry_type' => CotitulairesType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Divn::class,
        ]);
    }
}
