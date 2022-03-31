<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClasseType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/getAllM1", name="get_all_class_1")
     */
    public function getAllM1(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Classroom::class) ;
        $classrooms = $repository->findAll() ;
         dump($classrooms); die;
        return $this->render('classroom/list1.html.twig' , [
            'classrooms' => $classrooms,
        ]);
    }
    //inejection des dependeces
    // el function dump mte debocage
    /**
     * @Route("/getAllM2", name="get_all_class_2")
     */
    public function getAllM2(ClassroomRepository $repository): Response
    {
        $classrooms = $repository->findAll() ;
          dump($classrooms); die;
        return $this->render('classroom/list1.html.twig' , [
            'classrooms' => $classrooms,
        ]);
    }
    /**
     * @Route("/getAllM3", name="get_all_class")
     */
    public function getAllM3(ClassroomRepository $repository): Response
    {
        $classrooms = $repository->findAll() ;
        return $this->render('classroom/list.html.twig' , [
            'classrooms' => $classrooms,
        ]);
    }


    /**
     * @Route("/addclass", name="add_class")
     */
    public function addClass(Request $request): Response
    {
        $classroom = new Classroom() ;
        $form = $this->createForm(ClasseType::class , $classroom) ;
         $form->handleRequest($request) ;
         $em = $this->getDoctrine()->getManager() ;
         if($form->isSubmitted() && $form->isValid())
         {
             $em->persist($classroom);
             $em->flush();
             return $this->redirect("/getAllM3");
         }
        return $this->render('classroom/addClass.html.twig' , [
            'formClass' => $form->createView()
        ] );
    }
    /**
     * @Route("/classroom/update/{id}", name="classroom_update")
     */
    public function Update(Request $req, $id, ClassroomRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository(Classroom::class);
    
        $classroom = $repository->find($id);

        $form = $this->createForm(ClasseType::class, $classroom);

        $form->handleRequest($req);
        $isUpdate = true;
        if($form->isSubmitted() and $form->isValid()){
            $em->flush();
            return $this->redirect("/getAllM3");
        }

        return $this->render("classroom/addClass.html.twig", array(
            'formClass' => $form->createView(),
            'isUpdate' => $isUpdate
        ));
    }
    /**
     * @Route("/classroom/delete/{id}", name="classroom_delete")
     */
    public function Delete(Request $req, $id, ClassroomRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        $classroom = $repository->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirect("/getAllM3");
    }


        /**
     * @Route("/getOne/{id}", name="get_one_class")
     */
    public function getOne($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Classroom::class) ;
        $classroom = $repository->find($id) ;
        return $this->render('classroom/class.html.twig' , [
            'classroom' => $classroom,
        ]);
    }


}
