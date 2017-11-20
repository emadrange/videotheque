<?php

namespace FilmBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            'label' => 'Titre'
        ))
            ->add('author', TextType::class, array(
                'label' => 'Auteur'
            ))
            ->add('cover', TextType::class, array(
                'label' => 'Jaquette'
            ))
            ->add('resume', TextareaType::class, array(
                'label' => 'Résumé'
            ))
            ->add('releaseyear', DateTimeType::class, array(
                'label'       => 'Année de sortie',
                'years'       => range(1935, 2040),
                'format'      => 'dd-MM-yyyy',
                'widget'      => 'single_text',
                'placeholder' => 'dd-mm-yyyy',
                'data'        => new \DateTime()
            ))
            ->add('duration', TextType::class, array(
                'label' => 'Durée'
            ))
            ->add('actor', TextareaType::class, array(
                'label' => 'Acteur'
            ))
            ->add('genre', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Genres',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Genre'
            ))
            ->add('production', EntityType::class, array(
                'class' => 'FilmBundle\Entity\Productions',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Production'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FilmBundle\Entity\Films'
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
