<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\ClassroomRepository;
use App\Repository\StudentRepository;
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
        $em = $this->getDoctrine()->getManager() ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($student);
            $em->flush();
            return $this->redirect("/getAllStudent");
        }
        return $this->render('student/addStudent.html.twig' , [
                'formStudent' => $form->createView()
        ] );
    }

    /**
     * @Route("/getAllStudent", name="get_all_student")
     */
    public function getAllStudent(StudentRepository $repository): Response
    {
        $students = $repository->findAll() ;
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

}
