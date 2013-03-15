<?php

namespace Acme\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('website')
            ->add('books', 'entity'
                ,array(
                    'required'=>false
                    ,'multiple'=>true
                    ,'expanded'=>true
                    ,'class'=>'AcmeBookBundle:Book'
                    ,'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                        return $er->createQueryBuilder('cat')
                               ->andWhere('cat.isNovell = 1')
                               ->orderBy('cat.name', 'ASC');
                    }
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BookBundle\Entity\Author'
        ));
    }

    public function getName()
    {
        return 'acme_bookbundle_authortype';
    }
}
