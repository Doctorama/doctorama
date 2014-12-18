<?php

namespace DT\DoctoramaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TheseType extends AbstractType {

    private $archivage;

    public function __construct($archivage = false) {
        $this->archivage = $archivage;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder ->add('mention', 'choice', array(
                        'choices' => array('1' => 'Honorable', '2' => 'Très honorable', '3' => 'Très honorable avec félicitation', '4' => 'Abandonnée'),
                        'required' => false,
                    ));
        
        if (!$this->archivage) {
            $builder
                    ->add('titreThese', 'text')
                    ->add('sujetThese', 'text')
                    ->add('specialite', 'text', array('required' => false))
                    ->add('laboratoire', 'text', array('required' => false))
                    ->add('axeThematique', 'text', array('required' => false))
                    ->add('axeScientifique', 'text', array('required' => false))
                    ->add('financement', 'text', array('required' => false))
                    ->add('dateDebut', 'date', array('required' => false))
                    ->add('dateDeSoutenance', 'date', array('required' => false))

                    //->add('dossierDeSuivi')
                    ->add('encadrants', 'entity', array(
                        'class' => 'DTDoctoramaBundle:Encadrant',
                        'property' => 'nom',
                        'multiple' => true,
                        'expanded' => false
                            )
                    )
                    //->add('doctorant')
                    ->add('directeursDeThese', 'entity', array(
                        'class' => 'DTDoctoramaBundle:Encadrant',
                        'property' => 'nom',
                        'multiple' => true,
                        'expanded' => false
                            )
                    )
            //->add('doctorants')
            ;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'DT\DoctoramaBundle\Entity\These',
                //'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dt_doctoramabundle_these';
    }

}
