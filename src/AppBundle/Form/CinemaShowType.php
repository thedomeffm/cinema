<?php

namespace AppBundle\Form;

use AppBundle\Entity\Hall;
use AppBundle\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CinemaShowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'years' => range(date('Y'), date('Y') + 5),
                'months' => range(date('m'), date('m') + 2),
                'label' => 'Vorstellungsdatum'
            ])
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
                'choice_label' => 'name',
                'label' => 'Film'
            ])
            ->add('hall', EntityType::class, [
                'class' => Hall::class,
                'choice_label' => 'name',
                'label' => 'Saal'

            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CinemaShow'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cinemashow';
    }


}
