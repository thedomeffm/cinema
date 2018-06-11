<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,array(
                'label' => 'Vorname'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nachname'
            ))
            ->add('mail', EmailType::class, array(
                'label' => 'E-Mail Adresse'
            ))
            ->add('mailText', TextareaType::class, array(
                'mapped' => false,
                'label' => 'Ihre Nachricht',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Person'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_person';
    }
}
