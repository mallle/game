<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * @Route("/index", name="app_home")
     */
    public function index()
    {

        return $this->render('index.html.twig');

    }

}
