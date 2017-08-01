<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\Artifact;
use McvAdminBundle\Entity\Collection;
use McvAdminBundle\Service\CollectionFinder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CatalogOldController extends Controller
{
     /**
     * @Route("/catalog", name="catalog_index_old")
     */
    public function indexAction()
    {
        return $this->render('McvAdminBundle:catalog:index.catalog.html.twig');
    }
    
     /**
     * @Route("/collection-finder-old", name="collection-finder-old")
     */
    public function finderAction(Request $request)
    {
        //Tworzenie przycisku POST do rozpoczęcia skanowania plików
        $scan_button = $this->createFormBuilder()->add('submit', SubmitType::class,array('label'=>'Skanuj'))->getForm();
        $scan_button->handleRequest($request);
        
        if($scan_button->isSubmitted()){
          
            $findFiles = new CollectionFinder($this->getParameter('upload_dir'));
            $findFiles->findAll();
            return $this->render('McvAdminBundle:catalog:scan.catalog.html.twig', ['findFiles' => $findFiles,'scan_button'=>$scan_button->createView()]);
        }

        return $this->render('McvAdminBundle:catalog:list.catalog.html.twig', ['scan_button'=>$scan_button->createView()]);
    }
    
    /**
     * @Route("catalog/relation/old", name="relation")
     */
    public function addArtifactsToCollecitonAction(){
        $em = $this->getDoctrine()->getManager();
        
        $collection = new Collection();
        $artifact1 = new Artifact();
        $artifact2 = new Artifact();
        
        $collection->setName('Inny Persist');
        $artifact1->setInventoryNumber('MHMG-IN-100-2');
        $artifact2->setInventoryNumber('MHMG-IN-100-1');
        $em->persist($artifact1);
        $em->persist($artifact2);
        
        $collection->addArtifact($artifact1);
        $collection->addArtifact($artifact2);
        $em->persist($collection);

        $em->flush();
        return $this->render('McvAdminBundle:catalog:index.catalog.html.twig');
    }
    /**
     * @Route("catalog/view-collection-old/{slug}",defaults={"slug: 1"}, name="view-colleciton")
     * @return type
     */
    public function viewCollectionAction($slug){
        $doc = $this->getDoctrine();
        $repository = $doc->getRepository('McvAdminBundle:Collection');
        $collection = $repository->find($slug);
        echo $collection->getName();
        echo $collection->getDescription();
        return $this->render('McvAdminBundle:catalog:index.catalog.html.twig');
    
    }
}
