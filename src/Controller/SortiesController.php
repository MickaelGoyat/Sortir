<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Form\SortiesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sorties", name="sorties")
 */
class SortiesController extends AbstractController
{
    /**
     * @Route("/", name="sorties")
     */
    public function list()
    {
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortiesRepo->findAll();
        dump($sorties);

        return $this->render("sorties/sorties.html.twig", [
            "sorties" => $sorties
        ]);
    }

    /**
     * @Route("/{noSortie}", name="_modifier",
     *  requirements={"noSortie" : "\d+"},
     *  methods={"GET"})
     */
    public function modifier($noSortie, Request $request)
    {
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortiesRepo->find($noSortie);

        return $this->render('sorties/modifier.html.twig', ["sorties" => $sorties]);
    }

    /**
     * @Route ("/add", name="sorties_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $sorties = new Sorties();
        $sortiesForm = $this->createForm(SortiesType::class, $sorties);
        $sortiesForm->handleRequest($request);
        if ($sortiesForm->isSubmitted()) {
            $em->persist($sorties);
            $em->flush();
            $this->addFlash('sucess', 'La sortie à été sauvegarder!');
            return $this->redirectToRoute('sorties_modifier',
                ['$sorties' => $sorties->getNoSortie()]);
        }
        return $this->render('sorties/add.sorties.html.twig', [
            "sortiesForm" => $sortiesForm->createView()
        ]);
    }

}