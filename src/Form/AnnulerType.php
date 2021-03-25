<?php

namespace App\Form;

use App\Entity\Etats;
use App\Entity\Sorties;
use App\Repository\EtatsRepository;
use App\Repository\SitesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnulerType extends AbstractType
{
    private $etatsRepository;
    public function __construct(EtatsRepository $etatsRepository)
    {
        $this->etatsRepository = $etatsRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $etats = $this->etatsRepository->orderByNom();
        $builder
            ->add('descriptioninfos', TextareaType::class,  ['label' => 'Motif annulation'])
            ->add('etatSortie', EntityType::class,
                [
                    'choices' => $etats,
                    'class' => Etats::class,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }

}
