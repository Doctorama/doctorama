<?php

namespace DT\DoctoramaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncadrantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('nomUsage')
            ->add('civilite')
            ->add('prenom')
            ->add('adresse')
            ->add('mail')
            ->add('dateDeNaissance', 'date', array('required' => false, 'years' => range(date('Y') -100, date('Y')-15)))
            ->add('villeDeNaissance')
            ->add('paysDeNaissance')
            ->add('depDeNaissance')
            ->add('nationalite')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DT\DoctoramaBundle\Entity\Encadrant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dt_doctoramabundle_encadrant';
    }
}
