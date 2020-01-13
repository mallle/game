<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/persons", name="app_persons_list")
     */
    function list(PersonRepository $personRepo) {

        $persons = $personRepo->findAll();

        return $this->render('Person/list.html.twig', [
            'persons' => $persons,
        ]);
    }

    /**
     * @Route("/persons/new", name="app_persons_new")
     */
    function new (Request $request) {

        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        return $this->handleForm($person, $form, $request);

    }

    /**
     * @Route("/persons/{person}/edit", name="app_persons_edit")
     */
    public function edit(Person $person, Request $request)
    {
        $form = $this->createForm(PersonType::class, $person);

        return $this->handleForm($person, $form, $request);
    }

    /**
     * @Route("/persons/{person}/delete", name="app_persons_delete")
     */
    public function delete(Person $person, Request $request, PersonRepository $personRepo)
    {
        $this->em->remove($person);
        $this->em->flush();

        $persons = $personRepo->findAll();

        return $this->render('Person/list.html.twig', [
            'persons' => $persons,
        ]);
    }

    private function handleForm(Person $person, FormInterface $formInterface, Request $request)
    {
        // Handle form
        $formInterface->handleRequest($request);

        if ($formInterface->isSubmitted()) {
            if ($formInterface->isValid()) {

                $this->em->persist($person);
                $this->em->flush();

                return $this->redirect($this->generateUrl('app_persons_edit', ['person' => $person->getId()]));
            }
            //$this->addFlashMessage('error', '');
        }

        return $this->render('Person/edit.html.twig', [
            'form' => $formInterface->createView(),
            'person' => $person,
        ]);
    }

}
