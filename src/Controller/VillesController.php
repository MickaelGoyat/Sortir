<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Entity\PropertySearch;
use App\Form\VilleType;
use App\Form\PropertySearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/villes", name="villes")
 */
class VillesController extends AbstractController
{
    /**
     * @Route("/", name="villes")
     */
    public function list(Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $villeRepo = $this->getDoctrine()->getRepository(Villes::class);
        if ($form->isSubmitted() and $form->isValid()) {
            $villes = $villeRepo->findByNom($search);
        }
        else{
            $villes = $villeRepo->findAll();

        }

        return $this->render(
            "villes/index.html.twig",
            [
                "villes" => $villes,
                'form' => $form ->createView()
            ]

        );
    }

    /**
     * @Route("/{noVille}", name="_modifier",
     *  requirements={"noVille" : "\d+"},
     *  methods={"GET","POST"})
     */

    public function modifier($noVille, Request $request, EntityManagerInterface $em)
    {
        $villeRepo = $this->getDoctrine()->getRepository(Villes::class);
        $ville = $villeRepo->find($noVille);
        $villeForm = $this->createForm(VilleType::class, $ville);
        //dd($request->request->all());
        $villeForm->handleRequest($request);
        if ($villeForm->isSubmitted()) {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', 'Le lieu à été sauvegardé!');

            return $this->redirectToRoute(
                'villesvilles'

            );
        }

        return $this->render(
            'villes/modifier.html.twig',
            ["ville" => $ville, "villeForm" => $villeForm->createView()]
        );
    }




    /**
     * @Route ("/add", name="villes_add")
     */


    public function add(EntityManagerInterface $em, Request $request)
    {
        $ville = new Villes();
        $villeForm = $this->createForm(VilleType::class, $ville);

        $villeForm->handleRequest($request);
        if ($villeForm->isSubmitted()) {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('sucess', 'Le lieu à été sauvegarder!');
            return $this->redirectToRoute('villesvilles');
        }
        return $this->render('villes/add.html.twig', [
            "villeForm" => $villeForm->createView()
        ]);
    }


    /**
     * @Route("/delete/{noVille}", name="_delete",
     *  requirements={"noVille" : "\d+"},
     *  methods={"GET","POST"})
     */

    public function delete($noVille, Request $request, EntityManagerInterface $em){


        $villeRepo = $this->getDoctrine()->getRepository(Villes::class);

        $ville = $villeRepo->find($noVille);

        $em->remove($ville);

        $em->flush();

        return $this->render(
            'villes/delete.html.twig');



    }


}