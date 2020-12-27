<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/nous-contacter", name="contact")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(ContactType::class, null, [
                'user' => $this->getUser()
        ] );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('notice', 'Merci de nous avoir contacté. Nous équipe va vous répondre dans les meilleurs délais.');
            
            //ENVOYER MAIL
            $content = "Bonjour " . $form['firstname']->getData() . ", <br/><br/>
                        Merci de nous avoir contacté, nous équipe va vous répondre dans les meilleurs délais.";
            $content .= "<br/><hr>" .  $form['content']->getData();
            
            $mail = new Mail();
            $mail->send($form['email']->getData(), $form['firstname']->getData() . ' ' . $form['lastname']->getData(), 'On a reçu votre message !' , $content);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
