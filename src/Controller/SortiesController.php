<?php

namespace App\Controller;


use App\Entity\Sorties;
use App\Form\AnnulerType;
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

        return $this->render(
            "sorties/sorties.html.twig",
            [
                "sorties" => $sorties,
            ]
        );
    }

    /**
     * @Route("/{noSortie}", name="_modifier",
     *  requirements={"noSortie" : "\d+"},
     *  methods={"GET", "POST"})
     */
    public function modifier($noSortie, Request $request, EntityManagerInterface $em)
    {
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortiesRepo->find($noSortie);

        $sortiesForm = $this->createForm(SortiesType::class, $sorties);
        $sortiesForm->handleRequest($request);
        if ($sortiesForm->isSubmitted() and $sortiesForm->isValid()) {
            $em->persist($sorties);
            $em->flush();
            $this->addFlash('success', 'Le lieu à été sauvegardé!');

            return $this->redirectToRoute(
                'sortiessorties'

            );
        }

        return $this->render(
            'sorties/modifier.sorties.html.twig',
            ["sorties" => $sorties, "sortiesForm" => $sortiesForm->createView()]
        );
    }

    /**
     * @Route ("/add", name="sorties_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $sorties = new Sorties();
        $sortiesForm = $this->createForm(SortiesType::class, $sorties);
        $sortiesForm->handleRequest($request);
        if ($sortiesForm->isSubmitted() and $sortiesForm->isValid()) {
            $em->persist($sorties);
            $em->flush();
            $this->addFlash('sucess', 'La sortie à été sauvegarder!');

            return $this->redirectToRoute('sortiessorties');
        }

        return $this->render(
            'sorties/add.sorties.html.twig',
            [
                "sortiesForm" => $sortiesForm->createView(),
            ]
        );
    }

    /**
     * @Route("/delete/{noSortie}", name="_delete",
     *  requirements={"noSortie" : "\d+"},
     *  methods={"GET","POST"})
     */

    public function delete($noSortie, Request $request, EntityManagerInterface $em)
    {


        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);

        $sortie = $sortieRepo->find($noSortie);

        $em->remove($sortie);

        $em->flush();

        return $this->render(
            'sortie/delete.sorties.html.twig'
        );


    }


    /**
     * @Route("/annuler/{noSortie}", name="_annuler",
     *  requirements={"noSortie" : "\d+"},
     *  methods={"GET","POST"})
     */
    public function annuler($noSortie, Request $request, EntityManagerInterface $em)
    {
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortiesRepo->find($noSortie);

        $sortiesForm = $this->createForm(AnnulerType::class, $sorties);

        $sortiesForm->handleRequest($request);
        $em->persist($sorties);
        $em->flush();
        $this->addFlash('success', 'Le lieu à été sauvegardé!');


        dump($sortiesForm);
        return $this->render(
            'sorties/annuler.html.twig',
            ["sorties" => $sorties, "sortiesForm" => $sortiesForm->createView()]

        );
    }


}