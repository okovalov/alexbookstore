<?php

namespace Acme\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $entityManager = $options['em'];
        $transformer = new \Acme\BookBundle\Form\DataTransformer\CategoriesToCategory($entityManager);

        $builder
            ->add('name')
            ->add('price')
            ->add('color','text',array('required'=>false,'data'=>'-'))
            ->add('isNovell','checkbox',array('required'=>false,'data'=>false))
            ->add(
                $builder->create('categories', 'entity',array(
                    'class'=>'Acme\BookBundle\Entity\Category',
                    'required'=>false,
                    'expanded'=>true,
                    'multiple'=>false,
                    ))
                ->addModelTransformer($transformer)
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BookBundle\Entity\Book'
        ));

        $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName()
    {
        return 'acme_bookbundle_booktype';
    }
}
