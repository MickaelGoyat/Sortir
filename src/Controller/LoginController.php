<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/", name="login")
 */
class LoginController extends AbstractController
{
    #[Route('/', name: 'user_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'loginError' => $utils->getLastAuthenticationError(),
            'loginUsername' => $utils->getLastUsername(),
        ]);
    }

    #[Route('/logout', name: 'user_logout')]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}