<?php

namespace App\Form;

use App\Entity\Participants;
use App\Entity\Sites;
use App\Repository\SitesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    private $sitesRepository;
    public function __construct(SitesRepository $sitesRepository)
    {
        $this->sitesRepository = $sitesRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sites = $this->sitesRepository->orderByNom();
        $builder
            ->add('username', TextType::class)
            ->add('prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('telephone', TelType::class)
            ->add('mail', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type'            => PasswordType::class,
                'first_options'   => ['label' => 'Mot de passe'],
                'second_options'  => ['label' => 'Confirmation'],
                'invalid_message' => 'Les 2 mots de passes ne sont pas identiques!',
            ])
            ->add('sitesNoSite', EntityType::class, [
                'choices' => $sites,
                'class' => Sites::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}