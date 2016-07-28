<?php
namespace Blog\RunBlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('prenom')
        ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => false))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';


    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }


    public function getName()
    {
        return $this->getBlockPrefix();
    }
}

?>
