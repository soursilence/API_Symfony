<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Article;
use ApiBundle\Entity\Answer;
use ApiBundle\Entity\Rate;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesController extends FOSRestController {

    /**
     * @Rest\View
     */
    public function allAction() {
        $articles = $this->getDoctrine()->getRepository("ApiBundle:Article")
                ->findAll();

        return array('articles' => $articles);
    }

    /**
     * @Rest\View
     */
    public function getAction($id) {
        $article = $this->getDoctrine()->getRepository("ApiBundle:Article")
                ->findOneBy(array('id' => $id));
        return $article;

        if (!$article instanceof Article) {
            throw new NotFoundHttpException('Article not found');
        }

        return array('article' => $article);
    }

    /**
     * @Route("\new")
     * @Template("ApiBundle:Articles:new.html.twig")
     */
    public function newArticleAction(Request $request) {
        return $this->processForm($request, new Article());
    }

    /**
     * @Rest\View
     */
    public function newAction(Request $request) {
        return $this->processForm($request, new Article());
    }

    private function processForm($request, Article $article) {


        $form = $this->createForm("ApiBundle\Form\Type\ArticleType", $article, array('csrf_protection' => false));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();


            $response = new Response();
            $response->setStatusCode(201);


            $response->headers->set('Location', $this->generateUrl(
                            'api_article_get', array('id' => $article->getId()), true
                    )
            );


            return $response;
        }

        return \FOS\RestBundle\View\View::create($form, 400);
    }

    /**
     * @Rest\View
     */
    public function newAnswerAction(Request $request) {
        $answer = new Answer();

        $form = $this->createForm("ApiBundle\Form\Type\AnswerType", $answer, array('csrf_protection' => false));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();


            $response = new Response();
            $response->setStatusCode(201);


            $response->headers->set('Location', $this->generateUrl(
                            'api_article_get', array('id' => $answer->getArticle()->getId()), true
                    )
            );


            return $response;
        }

        return \FOS\RestBundle\View\View::create($form, 400);
    }

    /**
     * @Rest\View
     */
    public function newRateAction(Request $request) {
        $rate = new Rate();

        $form = $this->createForm("ApiBundle\Form\Type\RateType", $rate, array('csrf_protection' => false));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(201);

            $response->headers->set('Location', $this->generateUrl(
                            'api_article_get', array('id' => $rate->getArticle()->getId()), true
                    )
            );

            return $response;
        }

        return \FOS\RestBundle\View\View::create($form, 400);
    }

}
