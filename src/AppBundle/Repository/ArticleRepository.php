<?php

namespace AppBundle\Repository;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    function loadArticles(){
        
        $articles = $this->createQueryBuilder('a')
        ->select('a', 'i')
        ->join('a.images', 'i', 'WITH', 'a.id = i.articleId')
        ->getQuery()
        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY); 

        $encoders = array(new JsonEncoder());
        $serializer = new Serializer(array(), $encoders);
        $json = $serializer->serialize($articles, 'json');
        
        return $json;
        
        //return $articles;
    }
}
