<?php

namespace App\Form;

use App\Entity\Etats;
use App\Entity\Sorties;
use App\Repository\EtatsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortiesType extends AbstractType
{
    /**
     * @var EtatsRepository
     */
    private EtatsRepository $etatsRepository;

    public function __construct(EtatsRepository $etatsRepository)
    {
        $this->etatsRepository = $etatsRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $etats= $this->etatsRepository->orderByNom();
        $NoEtat= $this->etatsRepository->orderByNom();
        $builder
            ->add('nom', TextType::class)
            ->add('datedebut', DateType::class )
            ->add('datecloture', DateType::class)
            ->add('nbinscriptionsmax', IntegerType::class)
            ->add('duree', IntegerType::class)
            ->add('descriptioninfos', TextareaType::class)
            ->add('etatsortie', EntityType::class, [
                'choices' => $etats,
                'class' => Etats::class,
            ])
            ->add('urlphoto', TextType::class, ['label' => 'Lien photo'])
            ->add('organisateur', IntegerType::class)
            ->add('lieuxNoLieu', IntegerType::class)



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
            'etats' => null,
        ]);
    }
}
