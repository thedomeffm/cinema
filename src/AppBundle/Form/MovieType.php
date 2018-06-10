<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Filmname',
            ])
            ->add('ageRating', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '6' => 6,
                    '12' => 12,
                    '16' => 16,
                    '18' => 18
                ],
                'label' => 'Altersfreigabe',
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Spieldauer',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Beschreibung'
            ])

            ->add('overtime', CheckboxType::class, [
                'label' => 'Überlänge',
                'required' => false
            ])
            ->add('is3d', CheckboxType::class, [
                'label' => '3D Film',
                'required' => false
            ])
            ->add('normalPrice', NumberType::class, [
                'label' => 'Preis',
            ])
            ;

        /*
         * IF edit form you cant change the image
         */
        if (!$options['edit_form']) {
            $builder
                ->add('image', FileType::class, [
                'required' => false,
                ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Movie',
            'edit_form' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_movie';
    }


}
