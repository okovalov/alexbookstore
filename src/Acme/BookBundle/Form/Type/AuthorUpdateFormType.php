<?php

namespace Acme\BookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuthorUpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('website')
            ->add('books_novels', 'entity'
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
            ->add('books_not_novels', 'entity'
                ,array(
                    'required'=>false
                    ,'multiple'=>true
                    ,'expanded'=>true
                    ,'class'=>'AcmeBookBundle:Book'
                    ,'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                        return $er->createQueryBuilder('cat')
                               ->andWhere('cat.isNovell = 0')
                               ->orderBy('cat.name', 'ASC');
                    }
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BookBundle\Form\Model\AuthorUpdateFormModel'
        ));
    }

    public function getName()
    {
        return 'acme_bookbundle_authorupdate_formtype';
    }
}
