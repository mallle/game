<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/questions", name="app_questions_list")
     */
    function list(QuestionRepository $questionRepo) {

        $questions = $questionRepo->findAll();

        return $this->render('Question/list.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/questions/new", name="app_questions_new")
     */
    function new (Request $request) {

        $question = new Question();

        $form = $this->createForm(QuestionType::class, $question);

        return $this->handleForm($question, $form, $request);

    }

    /**
     * @Route("/questions/{question}/edit", name="app_questions_edit")
     */
    public function edit(Question $question, Request $request)
    {
        $form = $this->createForm(QuestionType::class, $question);

        return $this->handleForm($question, $form, $request);
    }

    /**
     * @Route("/questions/{question}/delete", name="app_questions_delete")
     */
    public function delete(Question $question, Request $request, QuestionRepository $questionRepo)
    {
        $this->em->remove($question);
        $this->em->flush();

        $questions = $questionRepo->findAll();

        return $this->render('Question/list.html.twig', [
            'questions' => $questions,
        ]);
    }

    private function handleForm(Question $question, FormInterface $formInterface, Request $request)
    {
        // Handle form
        $formInterface->handleRequest($request);

        if ($formInterface->isSubmitted()) {
            if ($formInterface->isValid()) {

                $this->em->persist($question);
                $this->em->flush();

                return $this->redirect($this->generateUrl('app_questions_edit', ['question' => $question->getId()]));
            }
            //$this->addFlashMessage('error', '');
        }

        return $this->render('Question/edit.html.twig', [
            'form' => $formInterface->createView(),
            'question' => $question,
        ]);
    }

}
