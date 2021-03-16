<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil", name="profil")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        return $this->render('profil/createProfil.html.twig', [
            'logo' => 'Ceci est le logo de sortir.com',
            'pseudo' => 'Pseudo',
            'prenom' => 'Prénom',
            'nom' => 'Nom',
            'telephone' => 'Téléphone',
            'email' => 'E-mail',
            'mdp' => 'Mot de passe',
            'confirmation' => 'Confirmation',
            'siteRattachement' => 'Site de rattachement',
            'photo' => 'Ma photo',
        ]);
    }
}