<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    //la methode login pour les user permet la connection des utilisateursvia la route login creer le chemin et la class
    //authentication permet de renvoyer une reponse en cas d'erreur
    /**
     *
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }


        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //la fonction render me permet d'envoyer a twig les infos qui seront affichés
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
     //la methode logout permet a l'utilisateur de se deconnecter
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
