<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StoryController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/stories", name="app_stories_list")
     */
    function list(StoryRepository $storyRepo) {

        $stories = $storyRepo->findAll();

        return $this->render('story/list.html.twig', [
            'stories' => $stories,
        ]);
    }

    /**
     * @Route("/stories/new", name="app_stories_new")
     */
    function new (Request $request) {

        $story = new Story();

        $form = $this->createForm(StoryType::class, $story);

        return $this->handleForm($story, $form, $request);

    }

    /**
     * @Route("/stories/{story}/edit", name="app_stories_edit")
     */
    public function edit(Story $story, Request $request)
    {
        $form = $this->createForm(StoryType::class, $story);

        return $this->handleForm($story, $form, $request);
    }

    /**
     * @Route("/stories/{story}/delete", name="app_stories_delete")
     */
    public function delete(Story $story, Request $request, StoryRepository $storyRepo)
    {
        $this->em->remove($story);
        $this->em->flush();

        $stories = $storyRepo->findAll();

        return $this->render('story/list.html.twig', [
            'stories' => $stories,
        ]);
    }

    private function handleForm(Story $story, FormInterface $formInterface, Request $request)
    {

        // Handle form
        $formInterface->handleRequest($request);

        if ($formInterface->isSubmitted()) {
            if ($formInterface->isValid()) {

                $this->em->persist($story);
                $this->em->flush();

                return $this->redirect($this->generateUrl('app_stories_edit', ['story' => $story->getId()]));
            }
            $this->addFlashMessage('error', '');
        }

        return $this->render('story/edit.html.twig', [
            'form' => $formInterface->createView(),
            'story' => $story,
        ]);
    }

}
