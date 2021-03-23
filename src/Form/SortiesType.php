<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('noSortie', IntegerType::class)
            ->add('nom', TextType::class)
            ->add('datedebut', DateType::class )
            ->add('datecloture', DateType::class)
            ->add('nbinscriptionsmax', IntegerType::class)
            ->add('duree', IntegerType::class)
            ->add('descriptioninfos', TextareaType::class)
            ->add('etatsortie', IntegerType::class)
            ->add('urlphoto', TextType::class)
            ->add('organisateur', IntegerType::class)
            ->add('lieuxNoLieu', IntegerType::class)
            ->add('etatsNoEtat', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
