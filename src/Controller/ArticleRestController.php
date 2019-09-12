<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;

/**
 * Article controller.
 * @Route("/api", name="api_")
 */
class ArticleRestController extends FOSRestController
{
    /**
     * Lists all Articles.
     * @Rest\Get("/articles")
     *
     * @return Response
     */
    public function getArticlesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();
        return $this->handleView($this->view($articles));
    }

    /**
     * Create Article.
     * @Rest\Post("/setarticle")
     *
     * @return array
     */
    public function postArticleAction(Request $request)
    {
        $article = new Article();
        $article->setTitle($request->get('title'));
        $article->setContent($request->get('content'));
        $article->setIsPublished($request->get("publier"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        return View::create($article, Response::HTTP_CREATED , []);

    }
}
