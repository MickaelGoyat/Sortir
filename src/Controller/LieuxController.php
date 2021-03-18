<?php
namespace App\Controller;

use App\Form\LieuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lieux;
use App\Repository\LieuxRepository;

/**
 * @Route("/lieux", name="lieux")
 */
class LieuxController extends AbstractController
{
    /**
     * @Route("/", name="lieux")
     */
    public function list()
    {
        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);
        $lieux = $lieuRepo->findAll();
        dump($lieux);


        return $this->render("lieux/index.html.twig",[
            "lieux" => $lieux
        ]

        );
    }

    /**
     * @Route("/{noLieu}", name="_modifier",
     *  requirements={"noLieu" : "\d+"},
     *  methods={"GET"})
     */

    public function modifier($noLieu, Request $request){


        $lieuRepo = $this->getDoctrine()->getRepository(Lieux::class);
        $lieu = $lieuRepo->find($noLieu);

        return $this->render('lieux/modifier.html.twig', ["lieu" => $lieu]
        );


    }
    /**
     * @Route ("/add", name="lieux_add")
     */

    public function add (EntityManagerInterface $em, Request $request){

        $lieu = new Lieux();
        $lieuForm = $this->createForm(LieuType::class, $lieu);

        $lieuForm->handleRequest($request);
        if ($lieuForm->isSubmitted()){
        $em->persist($lieu);
        $em->flush();
        $this->addFlash('sucess','Le lieu à été sauvegarder!');
        return $this->redirectToRoute('lieux_modifier',
            ['noLieu'=> $lieu->getNoLieu()
            ]);

        }
        return $this->render('lieux/add.html.twig' ,[
        "lieuForm" => $lieuForm->createView()
        ]);
    }

}