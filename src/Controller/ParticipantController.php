<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sites;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="participant")
     */
    public function index()
    {
        $participantRepo = $this->getDoctrine()->getRepository(Participants::class);
        $participants = $participantRepo->findAll();
        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites = $siteRepo->findAll();

        return $this->render('participant/create.html.twig', [
            'participants' => $participants,
            'sites' => $sites,
        ]);
    }

    /**
     * @Route("/{noParticipant}", name="_modifier",
     *  requirements={"noParticipant" : "\d+"},
     *  methods={"GET"})
     */

    public function modifier($noParticipant, Request $request)
    {
        $participantRepo = $this->getDoctrine()->getRepository(Participants::class);
        $participant = $participantRepo->find($noParticipant);

        return $this->render('participant/update.html.twig', ["participant" => $participant]
        );
    }

    /**
     * @Route ("/participant/add", name="participants_add")
     */
    public function add(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $participant = new Participants();
        $participantForm = $this->createForm(ParticipantType::class, $participant);

        $participantForm->handleRequest($request);
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
            $participant->setPassword($encoder->encodePassword($participant, $participant->getPassword()));
            $participant->setRoles(["ROLE_PARTICIPANT"]);
            $em->persist($participant);
            $em->flush();
            $this->addFlash('success', 'Le participant à été ajouté!');
            return $this->redirectToRoute('participant',
                ['$noParticipant' => $participant->getNoParticipant()
                ]);
        }
        return $this->render('participant/add.html.twig', [
            "participantForm" => $participantForm->createView()
        ]);
    }

    /**
     * @Route("/delete/{noParticipant}", name="_delete",
     *  requirements={"noParticipant" : "\d+"},
     *  methods={"GET","POST"})
     */
    public function delete($noParticipant, Request $request, EntityManagerInterface $em)
    {
        $participantRepo = $this->getDoctrine()->getRepository(Participants::class);
        $participant = $participantRepo->find($noParticipant);
        $em->remove($participant);
        $em->flush();

        return $this->render(
            'participant/delete.html.twig');

    }
}