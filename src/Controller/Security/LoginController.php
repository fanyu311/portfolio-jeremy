<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// 创建login 的路径 如果有错误的问题就提醒他
class LoginController extends AbstractController
{
    #[Route('/login', name: 'app.login', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();


        // last username entered by the user
        $lastUsername = $utils->getLastUsername();


        return $this->render('Security/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,
        ]);
    }
}
