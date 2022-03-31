<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Classroom;
use App\Form\StudentType;
use App\Repository\ClassroomRepository;
use App\Repository\StudentRepository;
use App\Form\SearchStudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTimeInterface; 
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Date;

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
    public function getAllStudent(StudentRepository $repository,Request $request): Response
    {
      //hethi get el kbira 
              $students = $repository->findAll() ;    
      // hethi fazet el order 
            // $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
           //  $students = $em->getStudentsOrderByEmail() ;


      //hethi email specifi
    //  $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
    //   $students = $em->getStudentsByEmailSpecific() ;



     //hethi email bech ta3tih enti f varriable f repository
   //  $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
    // $students = $em->search('chab') ;



    //hethi el recherche lezemk tzid f parametre mta3 function eli f controlleur
    $search = $request->query->get('search');
    if ($search) {
        $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
         $students = $em->search($search) ;
    }
    return $this->render('student/list.html.twig', [
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

     /**
     * @Route("/searchstudent", name="search_student")
     */
    public function searchByName(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
        $students = $em->getStudentsOrderByEmail();

        $search = $request->query->get('search');
        if ($search) {
            $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
             $students = $em->search($search) ;
        }
        return $this->render('student/list.html.twig', [
            'students' => $students,
        ]);
    }

  
    /**
     * @Route("/studentaa/{class}", name="studentOrderByClass")
     */
    public function orderStudents(Request $request,$class): Response
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->createQuery("SELECT s FROM App\Entity\Student s JOIN s.Classrooms c WHERE c.Name = :name")
                        ->setParameter('name', $class)->getResult();

        return $this->render('student/list.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/betweenDates", name="betweenDates")
     */
    public function betweenDates(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->createQuery("SELECT s FROM App\Entity\Student s WHERE s.creation_date between :val1 and :val2")
            ->setParameter('val1', '2022-03-01')
            ->setParameter('val2', '2022-03-02')
            ->getResult();

        return $this->render('student/list.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/getAllStudentEnabled", name="get_all_student_Enabled")
     */
    public function getAllStudentEnabled(StudentRepository $repository,Request $request): Response
    {
      
      // hethi fazet el order 
             $em = $this->getDoctrine()->getManager()->getRepository(Student::class);
            $students = $em->getStudentsEnabled() ;




    
    return $this->render('student/list.html.twig', [
        'students' => $students,
    ]);
}
    

}
