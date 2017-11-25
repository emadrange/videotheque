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
                'label' => 'forms.resume',
                'required' => false,
                'attr' => array(
                    'rows' => 6,
                    'cols' => 40
                )
            ))
            ->add('releaseyear', DateTimeType::class, array(
                'label'       => 'forms.releaseyear',
                'years'       => range(1900, 2100),
                'format'      => 'dd-MM-yyyy',
                'widget'      => 'single_text',
                'placeholder' => 'dd-mm-yyyy',
                'attr' => array(
                    'class' => 'datepicker'
                )
            ))
            ->add('duration', TextType::class, array(
                'label' => 'forms.duration',
                'required' => false
            ))
            ->add('actor', TextareaType::class, array(
                'label' => 'forms.actor',
                'required' => false,
                'attr' => array(
                    'rows' => 4,
                    'cols' => 40
                )
            ))
            ->add('genre', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Genres',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'forms.genre.label',
                'placeholder' => 'forms.genre.placeholder'
            ))
            ->add('production', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Productions',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'forms.production',
                'placeholder' => 'forms.production.placeholder'
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
