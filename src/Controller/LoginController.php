<?php


namespace App\Controller;

use App\Entity\Participants;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/', name: 'user_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'LoginController',
            'loginError' => $utils->getLastAuthenticationError(),
            'loginUsername' => $utils->getLastUsername(),
        ]);
    }

    #[Route('/register', name: 'user_register')]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder,
    ): Response
    {
        $user = new Participants;
        $registrationForm = $this->createForm(RegistrationType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Inscription réussie');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    #[Route('/profil', name: 'after_login_route_name')]
    public function profil(): Response
    {
        return $this->render('profil/createProfil.html.twig', [
            'logo' => 'Ceci est le logo de sortir.com',
            'pseudo' => 'Pseudo',
            'prenom' => 'Prénom',
            'nom' => 'Nom',
            'telephone' => 'Téléphone',
            'email' => 'E-mail',
            'password' => 'Mot de passe',
            'confirmation' => 'Confirmation',
            'siteRattachement' => 'Site de rattachement',
            'photo' => 'Ma photo',
        ]);
    }

    #[Route('/logout', name: 'user_logout')]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}