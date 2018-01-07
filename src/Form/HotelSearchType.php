<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelSearchType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('city', TextType::class)
            ->add('price_from', NumberType::class)
            ->add('price_to', NumberType::class)
            ->add('available_from', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('available_to', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('sort_by', TextType::class)


            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'allow_extra_fields' => false,
            'method' => Request::METHOD_GET,
        ));
    }
}