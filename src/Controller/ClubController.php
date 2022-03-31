<?php

namespace App\Controller;
use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }


    /**
     * @Route("/getAllClub", name="get_all_club")
     */
    public function getAllClub(ClubRepository $repository): Response
    {
        $clubs = $repository->findAll() ;
        return $this->render('club/list.html.twig' , [
            'clubs' => $clubs,
        ]);
    }



    /**
     * @Route("/addClub", name="add_Club")
    */
    public function addClub(Request $request): Response
    {  
        $club = new Club() ;
        $form = $this->createForm(ClubType::class , $club) ;
        $form->handleRequest($request) ;
        $em = $this->getDoctrine()->getManager() ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($club);
            $em->flush();
            return $this->redirect("/getAllClub");
        }
        return $this->render('club/create.html.twig' , [
                'formClub' => $form->createView()
        ] );
    }


         /**
     * @Route("/club/update/{Ref}", name="club_update")
     */
    public function Update(Request $req, $Ref, ClubRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository(Classroom::class);
    
        $club = $repository->find($Ref);

        $form = $this->createForm(ClubType::class, $club);

        $form->handleRequest($req);
        $isUpdate = true;
        if($form->isSubmitted() and $form->isValid()){
            $em->flush();
            return $this->redirect("/getAllClub");
        }

        return $this->render("club/create.html.twig", array(
            'formClub' => $form->createView(),
            'isUpdate' => $isUpdate
        ));
    }

    
    /**
     * @Route("/club/delete/{Ref}", name="club_delete")
     */
    public function Delete(Request $req, $Ref, ClubRepository  $repository): Response {

        $em = $this->getDoctrine()->getManager();
        $club = $repository->find($Ref);
        $em->remove($club);
        $em->flush();
        return $this->redirect("/getAllClub");
    }
}