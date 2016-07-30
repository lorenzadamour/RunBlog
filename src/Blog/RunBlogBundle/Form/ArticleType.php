<?php

namespace Blog\RunBlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', null, array('label' => false,'attr' => array('placeholder' => "Titre de l'article ",)))
            ->add('description', null, array('label' => false,'attr' => array('placeholder' => "Description de l'article",)))
            ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => false))
            ->add('public')
            ->add('public', ChoiceType::class, array(
              'placeholder' => 'Publier ?',
              'label' => false,
              'choices' => array(
                'oui' => 'oui',
                'non' => 'non',
              )
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\RunBlogBundle\Entity\Article'
        ));
    }
}
