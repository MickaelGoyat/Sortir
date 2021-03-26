<?php

namespace App\Controller;


use App\Entity\PropertySearch;
use App\Entity\Sites;
use App\Form\PropertySearchType;
use App\Form\SiteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sites", name="sites")
 */
class SitesController extends AbstractController
{
    /**
     * @Route("/", name="sites")
     */
    public function list(Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        if ($form->isSubmitted() and $form->isValid()) {
            $sites = $siteRepo->findByNom($search);
        } else {
            $sites = $siteRepo->findAll();
        }
        return $this->render("sites/index.html.twig", [
                "sites" => $sites,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/{noSite}", name="_modifier",
     *  requirements={"noSite" : "\d+"},
     *  methods={"GET","POST"})
     */
    public function modifier($noSite, Request $request, EntityManagerInterface $em)
    {
        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $site = $siteRepo->find($noSite);
        $siteForm = $this->createForm(SiteType::class, $site);
        $siteForm->handleRequest($request);
        if ($siteForm->isSubmitted()) {
            $em->persist($site);
            $em->flush();
            $this->addFlash('success', 'Le lieu à été sauvegardé!');
            return $this->redirectToRoute(
                'sitessites'
            );
        } else {
            //  dump($site);
        }
        return $this->render(
            'sites/modifier.html.twig',
            ["site" => $site, "siteForm" => $siteForm->createView()]
        );
    }

    /**
     * @Route ("/add", name="sites_add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $site = new Sites();
        $siteForm = $this->createForm(SiteType::class, $site);

        $siteForm->handleRequest($request);
        if ($siteForm->isSubmitted() and $siteForm->isValid()) {
            $em->persist($site);
            $em->flush();
            $this->addFlash('sucess', 'Le lieu à été sauvegarder!');

            return $this->redirectToRoute(
                'sitessites'
            );

        }
        return $this->render(
            'sites/add.html.twig',
            [
                "siteForm" => $siteForm->createView(),
            ]
        );
    }

    /**
     * @Route("/delete/{noSite}", name="_delete",
     *  requirements={"noSite" : "\d+"},
     *  methods={"GET","POST"})
     */


    public function delete($noSite, Request $request, EntityManagerInterface $em)
    {


        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $site = $siteRepo->find($noSite);

        $em->remove($site);
        $em->flush();

        return $this->render(
            'sites/delete.html.twig');


    }

}
