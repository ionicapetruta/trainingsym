<?php

namespace Acme\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function recentArticlesAction()
    {
        $articles =array(
            "foo" => "bar",
            "bar" => "foo",
            "car" => "far"
        );
        return $this->render(
            '@AcmeArticle/Article/base.html.twig',
             array('articles' => $articles)
        );
    }
}
