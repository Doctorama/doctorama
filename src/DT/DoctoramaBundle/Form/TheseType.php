<?php

namespace DT\DoctoramaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TheseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreThese','text')
            ->add('sujetThese', 'text')
            ->add('specialite', 'text', array('required' => false))
            ->add('laboratoire', 'text', array('required' => false))
            ->add('axeThematique', 'text', array('required' => false))
            ->add('axeScientifique', 'text', array('required' => false))
            ->add('financement', 'text', array('required' => false))
            ->add('dateDebut','date', array('required' => false))
            ->add('dateDeSoutenance','date', array('required' => false))
            ->add('mention', 'text', array('required' => false))
            //->add('dossierDeSuivi')
            ->add('encadrants','entity', array(
                'class'    => 'DTDoctoramaBundle:Encadrant',
                'property' => 'nom',
                'multiple' => true,
                'expanded' => true
              ))
            //->add('doctorant')
            ->add('directeursDeThese','entity', array(
                'class'    => 'DTDoctoramaBundle:Encadrant',
                'property' => 'nom',
                'multiple' => true,
                'expanded' => true))
            //->add('doctorants')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DT\DoctoramaBundle\Entity\These',
            //'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dt_doctoramabundle_these';
    }
}
