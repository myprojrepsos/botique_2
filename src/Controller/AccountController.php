<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte/commande", name="account")
     */
    public function index()
    {
        return $this->render('account/index.html.twig');
    }
}
