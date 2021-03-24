<?php

namespace App\Controller;

use App\Entity\Lieux;
use App\Entity\PropertySearch;
use App\Form\LieuType;
use App\Form\PropertySearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lieux", name="lieux")
 */
class LieuxController extends AbstractController
{
    /**
     * @Route("/", name="lieux")
     */
    public function list(Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class , $search);
        $form->handleRequest($request);
        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);
        if ($form->isSubmitted() and $form->isValid()) {
            $lieux = $lieuRepo->findByNom($search);
        }
        else{
            $lieux = $lieuRepo->findAll();

        }

        return $this->render(
            "lieux/index.html.twig",
            [
                "lieux" => $lieux,
                'form' => $form ->createView()
            ]

        );
    }

    /**
     * @Route("/{noLieu}", name="_modifier",
     *  requirements={"noLieu" : "\d+"},
     *  methods={"GET","POST"})
     */
    public function modifier($noLieu, Request $request, EntityManagerInterface $em)
    {
        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);
        $lieu = $lieuRepo->find($noLieu);
        $lieuForm = $this->createForm(LieuType::class, $lieu);
        //dd($request->request->all());
        $lieuForm->handleRequest($request);
        if ($lieuForm->isSubmitted()) {
            $em->persist($lieu);
            $em->flush();
            $this->addFlash('success', 'Le lieu à été sauvegardé!');

            return $this->redirectToRoute(
                'lieuxlieux'

            );
        }

            return $this->render(
                'lieux/modifier.html.twig',
                ["lieu" => $lieu, "lieuForm" => $lieuForm->createView()]
            );
    }


    /**
     * @Route ("/add", name="lieux_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $lieu = new Lieux();
        $lieuForm = $this->createForm(LieuType::class, $lieu);

        $lieuForm->handleRequest($request);
        if ($lieuForm->isSubmitted()) {
            $em->persist($lieu);
            $em->flush();
            $this->addFlash('sucess', 'Le lieu à été sauvegarder!');
            return $this->redirectToRoute('lieux_modifier',
                ['noLieu' => $lieu->getNoLieu()]);
        }
        return $this->render('lieux/add.html.twig', [
            "lieuForm" => $lieuForm->createView()
        ]);
    }


    /**
     * @Route("/delete/{noLieu}", name="_delete",
     *  requirements={"noLieu" : "\d+"},
     *  methods={"GET","POST"})
     */

    public function delete($noLieu, Request $request, EntityManagerInterface $em){


        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);

        $lieu = $lieuRepo->find($noLieu);

        $em->remove($lieu);

        $em->flush();

        return $this->render(
            'lieux/delete.html.twig');



    }


}