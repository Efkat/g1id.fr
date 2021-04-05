<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return new Response(
            '<html lang="fr"><body>Hello</body></html>'
        );
    }

    public function homeLogged(): Response
    {
        return new Response("<html> HELLO USER </html>");
    }
}
