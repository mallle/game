<?php

namespace App\Controller;

use App\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class StoryController extends AbstractController
{

    /**
     * @Route("/story/new")
     */
    function new () {

        $story = new Story();

        $form = $this->createFormBuilder($story)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Story'])
            ->getForm();

        // ...

        return $this->render('story/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
