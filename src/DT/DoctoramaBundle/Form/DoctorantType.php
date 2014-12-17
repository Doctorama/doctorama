<?php

namespace DT\DoctoramaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DT\DoctoramaBundle\Form\TheseType;

class DoctorantType extends AbstractType
{
    private $withThese;
    
    public function __construct($withThese = false) {
        $this->withThese = $withThese;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $builder
            ->add('numEtudiant', 'text', array('required' => false))
            ->add('bourseEtExoneration', 'text', array('required' => false))
            ->add('dateInscr1eThese', 'text', array('required' => false))
            ->add('dcace', 'text', array('required' => false))
            ->add('nomFormationMaster', 'text', array('required' => false))
            ->add('universiteMaster', 'text', array('required' => false))
            ->add('sujetMaster', 'text', array('required' => false))
            ->add('laboratoireAcceuilMaster', 'text', array('required' => false))
            ->add('encadrantsMaster', 'text', array('required' => false))
            ->add('etabDernierDiplome', 'text', array('required' => false))
            ->add('depDernierDiplome', 'text', array('required' => false))
            ->add('paysDernierDiplome', 'text', array('required' => false))
            ->add('libelleDernierDiplome', 'text', array('required' => false))
            ->add('anneeDernierDiplome', 'text', array('required' => false))
            ->add('nom','text')
            ->add('nomUsage', 'text', array('required' => false))
            ->add('civilite', 'text', array('required' => false))
            ->add('prenom','text')
            ->add('adresse', 'text', array('required' => false))
            ->add('mail','text')
            ->add('nationalite','text', array('required' => false))
            ->add('dateDeNaissance','date', array('required' => false))
            ->add('villeDeNaissance', 'text', array('required' => false))
            ->add('paysDeNaissance', 'text', array('required' => false))
            ->add('depDeNaissance', 'text', array('required' => false));
        
        if($this->withThese)
            $builder->add('these', new TheseType(),array(
                            'data_class' => 'DT\DoctoramaBundle\Entity\These'));

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DT\DoctoramaBundle\Entity\Doctorant',
            //'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dt_doctoramabundle_doctorant';
    }
}
