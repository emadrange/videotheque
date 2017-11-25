<?php

namespace FilmBundle\Form;

use Doctrine\ORM\EntityRepository;
use FilmBundle\Entity\Films;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmsType extends AbstractType
{
    /**
     * Film form
     *
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
            'label' => 'forms.title'
        ))
            ->add('author', TextType::class, array(
                'label' => 'forms.author'
            ))
            ->add('cover', FileType::class, array(
                'label' => 'forms.cover',
                'data_class' => null,
                'required' => false
            ))
            ->add('resume', TextareaType::class, array(
                'label' => 'forms.resume'
            ))
            ->add('releaseyear', DateTimeType::class, array(
                'label'       => 'forms.releaseyear',
                'years'       => range(1935, 2040),
                'format'      => 'dd-MM-yyyy',
                'widget'      => 'single_text',
                'placeholder' => 'dd-mm-yyyy'
            ))
            ->add('duration', TextType::class, array(
                'label' => 'forms.duration'
            ))
            ->add('actor', TextareaType::class, array(
                'label' => 'forms.actor'
            ))
            ->add('genre', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Genres',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'forms.genre'
            ))
            ->add('production', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Productions',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'forms.production'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Films::class,
            'translation_domain' => 'messages'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'filmbundle_films';
    }


}
