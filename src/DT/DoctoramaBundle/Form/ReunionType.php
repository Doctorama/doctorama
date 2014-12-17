<?php

namespace DT\DoctoramaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReunionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu')
            ->add('date')
           ->add('encadrants','entity',array('class'=>'DTDoctoramaBundle:Encadrant','property'=>'nom','multiple'=>true,'expanded'=>true))
           ->add('doctorant','entity',array('class'=>'DTDoctoramaBundle:Doctorant','property'=>'nom','multiple'=>false,'expanded'=>true))
           ->add('libelle')


        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DT\DoctoramaBundle\Entity\Reunion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dt_doctoramabundle_reunion';
    }
}
