<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller {
/**
 * 
 * @Route("/blog", name="blog")
 */
    public function indexAction(){
        return $this->render('blog/index.html.twig');
    }
    /**
     * 
     * @Route("blog/list", name="list")
     */
    public function listAction(){
        return $this->render('blog/list.html.twig');
    }
    /**
     * 
     * @param type $slug int
     * @Route("/blog/show/{slug}",defaults={"slug: 1"}, name="blog_show", requirements={"slug":"\d+"})
     */
    public function showAction($slug){
        return $this->render('blog/show.html.twig');
    }
    /**
     * 
     * @param type $name
     * @Route("/blog/container/{name}", name="container")
     */
    public function containerAction($name){
        $expression = $this->get($name);
        var_dump($expression);
        return $this->render('blog/index.html.twig');
    }
    /**
     * 
     * @param type $filter
     * @Route("/blog/show/filter/{filter}", name="blog_filter")
     */
    public function filterAction($filter = "makaron"){
        return $this->render('blog/filter.html.twig');
    }
    /**
     * 
     * @param type $where
     * @Route("/blog/redirect/{where}", name="redirect")
     */
    public function redirectAction($where){
        return $this->redirectToRoute('blog_filter', array('filter' => $where));
    }
    /**
     * @Route("/blog/container/param/{param}", name="container_param")
     */
    public function getParamAction($param){
        $expression = $this->getParameter($param);
        var_dump($expression);
        return $this->render('blog/index.html.twig');
    }
    /**
     * 
     * @Route("/blog/session", name="session")
     */
    public function getSessionAction(Request $request){
        $session = $request->getSession();
        $session->set('Otworzył?', 'Tak');
        var_dump($session);
        $filters = $session->get('filters', []);
        var_dump($filters);
        return $this->render('blog/index.html.twig');
    }
    /**
     * 
     * @Route("/blog/flash", name="flash")
     */
    public function flashAction(Request $request){
        if($_POST){        
        #if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo 'Hello world';
            $this->addFlash('notice', 'Nacisnieto przycisk i wyslano formularz. Dzięki');
        }
        return $this->render('blog/flash.html.twig');
    }
    /**
     * 
     * @Route("/blog/json", name="json")
    */
    public function jsonAction(){
        $tablica = ['Powiedzmuy'=>'Że to asocjacja','jakich malo' => 'w tym przertazliwym swiecie', 'co zrobisz'=>'gdy przyjda po ciepie'];
        $tablica = array_map('htmlentities', $tablica);
        print_r($tablica);
        $json = html_entity_decode($tablica);
        return $this->json($json);
    }
    /**
     * 
     * @Route("/blog/file")
     */
    public function getFileAction(){
        return $this->file('spi4.png','nowa_nazwa_pliku.png');
        #return $this->render('blog/index.html.twig');
    }
    
    
}
