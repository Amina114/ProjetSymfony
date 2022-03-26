<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\ClassroomRepository;
use App\Repository\StudentRepository;
use App\Form\SearchStudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }


    /**
     * @Route("/addStudent", name="add_Student")
     */
    public function addStudent(Request $request): Response
    {
        $student = new Student() ;
        $form = $this->createForm(StudentType::class , $student) ;
        $form->handleRequest($request) ;
        $isUpdate = false;
        $em = $this->getDoctrine()->getManager() ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($student);
            $em->flush();
            return $this->redirect("/getAllStudent");
        }
        return $this->render('student/addStudent.html.twig' , [
                'formStudent' => $form->createView() , 
                'isUpdate' => $isUpdate
        ] );
    }

    /**
     * @Route("/getAllStudent", name="get_all_student")
     */
    public function getAllStudent(StudentRepository $repository): Response
    {
      //hethi get el kbira 
             // $students = $repository->findAll() ;


      // hethi fazet el order 
            // $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
           //  $students = $em->getStudentsOrderByEmail() ;


      //hethi emial specifi
    //   $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
     //  $students = $em->getStudentsByEmailSpecific() ;


     //hethi email behc ta3tih enti f varriable
     $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
     $students = $em->getStudentsByEmailSpecific2('chab') ;
    
        return $this->render('student/list.html.twig' , [
            'students' => $students,
        ]);
    }


    /**
     * @Route("/student/delete/{NSC}", name="student_delete")
     */
    public function Delete(Request $req, $NSC, StudentRepository  $repository): Response {

        $em = $this->getDoctrine()->getManager();
        $student = $repository->find($NSC);
        $em->remove($student);
        $em->flush();
        return $this->redirect("/getAllStudent");
    }

      /**
     * @Route("/student/update/{NSC}", name="student_update")
     */
    public function Update(Request $req, $NSC, StudentRepository $repository): Response {

        $em = $this->getDoctrine()->getManager();
        //$repo = $em->getRepository(Classroom::class);
    
        $student = $repository->find($NSC);

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($req);
        $isUpdate = true;
        if($form->isSubmitted() and $form->isValid()){
            $em->flush();
            return $this->redirect("/getAllStudent");
        }

        return $this->render("student/addStudent.html.twig", array(
            'formStudent' => $form->createView(),
            'isUpdate' => $isUpdate
        ));
    }

}
