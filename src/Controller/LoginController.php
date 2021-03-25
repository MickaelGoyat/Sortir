<?php


namespace App\Controller;

use App\Entity\Participants;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
use App\Repository\ParticipantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
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
        \Swift_Mailer $mailer
    ): Response
    {
        $user = new Participants;
        $registrationForm = $this->createForm(RegistrationType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            //generate activation_token
            $user->setActivationToken(md5(uniqid()));
            $entityManager->persist($user);
            $entityManager->flush();

            //send mail
            $message = (new \Swift_Message('Activation de votre compte'))
                //add expéditeur
                ->setFrom('Heroiikdefender@gmail.com')
                //add destinataire
                ->setTo($user->getMail())
                //add contenu
                ->setBody($this->renderView('emails/activation.html.twig', ['token' => $user->getActivationToken()]),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Inscription réussie');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    #[Route('/activation/{token}', name: 'activation')]
    public function activation($token, ParticipantsRepository $participantsRepo, EntityManagerInterface $entityManager): RedirectResponse
    {
        //validate user token
        $user = $participantsRepo->findOneBy(['activation_token' => $token]);

        //nothing user exists with token
        if (!$user) {
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        //delete token
        $user->setActivationToken(null);
        $entityManager->persist($user);
        $entityManager->flush();

        //Message flash
        $this->addFlash('message', 'Vous avez bien activé votre compte');

        //Return Accueil
        return $this->redirectToRoute('user_login');
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
        throw new Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/forgot-password', name: 'forgotten_password')]
    public function forgottenPassword(Request $request,
                                      EntityManagerInterface $entityManager,
                                      ParticipantsRepository $participantsRepo,
                                      \Swift_Mailer $mailer,
                                      TokenGeneratorInterface $tokenGenerator)
    {
        $form = $this->createForm(ResetPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = $participantsRepo->findOneBy(['mail' => $data]);

            if (!$user) {
                $this->addFlash('danger', 'Cette adresse n\'existe pas');
                $this->redirectToRoute('user_login');
            }

            $token = $tokenGenerator->generateToken();
            try {
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', 'Une erreur est survenue : ' . $e->getMessage());
                return $this->redirectToRoute('user_login');
            }

            $url = $this->generateUrl('reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('no-reply@sortir.com')
                ->setTo($user->getMail())
                ->setBody(
                    "<p>Bonjour,</p><p>Une demande de réinitialisation de mot de passe a été effectuée pour le site Sortir.com.
                           Veuillez cliquer sur le lien suivant : " . $url . '</p>', 'text/html'
                );
            $mailer->send($message);

            $this->addFlash('message', 'Un mail de réinitilialisation de mot de passe vous a été envoyé');

            return $this->redirectToRoute('user_login');
        }
        return $this->render('user/forgotten_password.html.twig', ['emailForm' => $form->createView()]);
    }

    #[Route('/reset-password/{token}', name: 'reset_password')]
    public function resetPassword($token, Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $user = $this->getDoctrine()->getRepository(Participants::class)->findOneBy(['reset_token' => $token]);
        if(!$user) {
            $this->addFlash('danger', 'Token inconnu');
            return $this->redirectToRoute('user_login');
        }
        if($request->isMethod('POST')) {
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Mot de passe modifié avec succès');
            return $this->redirectToRoute('user_login');
        } else{
            return $this->render('user/reset_password.html.twig', ['token' => $token]);
        }
    }
}