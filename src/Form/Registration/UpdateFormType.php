<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Registration;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateFormType extends AbstractType
{
    // /**
    //  * @var string
    //  */
    // private $class;

    // /**
    //  * @param string $class The User class name
    //  */
    // public function __construct($class)
    // {
    //     $this->class = $class;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'form.email', 
                'translation_domain' => 'FOSUserBundle'
                ))
            ->add('username', null, array(
                'label' => "Confirmer adresse mail", 
                'translation_domain' => 'FOSUserBundle'
                ))
            ->add('plainPassword', PasswordType::class, array(
                'label' => 'form.password', 
                'translation_domain' => 'FOSUserBundle',
                'required' => false
                ))
            // ->add('plainPassword', RepeatedType::class, array(
            //     'type' => PasswordType::class,
            //     'options' => array(
            //         'translation_domain' => 'FOSUserBundle',
            //         'attr' => array(
            //             'autocomplete' => 'new-password',
            //         ),
            //     ),
            //     'first_options' => array('label' => 'form.password'),
            //     'second_options' => array('label' => 'form.password_confirmation'),
            //     'invalid_message' => 'fos_user.password.mismatch',
            // ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_token_id' => 'registration',
        ]);
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => $this->class,
    //         'csrf_token_id' => 'registration',
    //     ));
    // }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_registration';
    }
}
