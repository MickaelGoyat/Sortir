<?php
namespace App\Controller;

use App\Entity\Sites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sites", name="sites")
 */
class SitesController extends AbstractController
{
    /**
     * @Route("/", name="sites")
     */
    public function list()
    {
        $siteRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites = $siteRepo->findAll();
        dump($sites);


        return $this->render("sites/index.html.twig",[
                "sites" => $sites
            ]

        );
    }
}