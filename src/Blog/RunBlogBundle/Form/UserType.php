<?php

namespace Blog\RunBlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateDeNaissance', DateType::class, array('years' => range(1940,2016),))
            ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => true))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\RunBlogBundle\Entity\User'
        ));
    }
    public function getParent()
  {
    return 'FOS\UserBundle\Form\Type\RegistrationFormType';
  }
}
