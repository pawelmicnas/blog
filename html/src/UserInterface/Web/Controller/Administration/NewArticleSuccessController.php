<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewArticleSuccessController extends AbstractController
{
    #[Route('article/success', name: 'article_success')]
    public function __invoke(): Response
    {
        return $this->render('administration/article/success.html.twig');
    }
}