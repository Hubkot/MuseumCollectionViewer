<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\Artifact;
use McvAdminBundle\Entity\ArtifactFiles;
use McvAdminBundle\Service\CollectionFinder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class FinderController extends Controller
{
     /**
     * @Route("/finder", name="catalog_index")
     */
    public function indexAction()
    {
        echo 'I am new Controller';
        return $this->render('McvAdminBundle:catalog:index.catalog.html.twig');
    }
    /**
     * @Route("/clear-session",name="clear_session")
     * @param Request $request
     * @return RedirectResponse
     */
    
    public function clearSession(Request $request){
        $request->getSession()->clear();
        return new RedirectResponse($this->generateUrl('collection-finder'));
        
    }
     /**
     * @Route("/collection-finder", name="collection-finder")
     */
    public function finderAction(Request $request)
    {
        $sesja = $request->getSession();
        $importBag = $sesja->get('Wyszukane');
        
        //Tworzenie przycisku POST do rozpoczęcia skanowania plików
        $scan_button = $this->createFormBuilder()->add('submit', SubmitType::class,array('label'=>'Skanuj'))->getForm();
        $scan_button->handleRequest($request);
        
        //Przycisk importu wszystkich plików
        if($scan_button->isSubmitted()){
            $findFiles = new CollectionFinder($this->getParameter('upload_dir'));
            $sesja->set('Wyszukane', $findFiles->findAll());
            $importBag = $sesja->get('Wyszukane');
            return $this->render('McvAdminBundle:catalog:scan.catalog.html.twig', ['findFiles' => $importBag,'scan_button'=>$scan_button->createView()]);
        }
         if($importBag){
           
           return $this->render('McvAdminBundle:catalog:scan.catalog.html.twig', ['findFiles' => $importBag,'scan_button'=>$scan_button->createView()]);
        }
        return $this->render('McvAdminBundle:catalog:list.catalog.html.twig', ['scan_button'=>$scan_button->createView()]);
    }
    /**
     * @Route("/{id}/import", name="admin_post_import")
     */
    public function importFile(Request $request){
        $this->addFlash('success', 'zaimportowano plik!');
        return new RedirectResponse($this->generateUrl('collection-finder'));
    }
    
    /**
     * @Route("/import-all", name="admin_import_all")
     * @param Request $request
     * @return RedirectResponse
     */
    public function importAll(Request $request){
        
        $bag = $request->getSession()->get('Wyszukane');
        $em = $this->getDoctrine()->getManager();
        foreach ($bag as $i){
            $artifactModel = new Artifact();
          
            $artifact = $em->getRepository('McvAdminBundle:Artifact')->findBy(array('inventoryNumber'=>$i['inventory_number']));
             
        if($artifact){
             echo 'Znalazłem w bazie';
             $artifactFile = new ArtifactFiles();
             $artifactFile->setFilename($i['inventory_number']
                                          .$i['photo_number']
                                          .$i['category_symbol']
                                          .'.'.$i['file_extension']);
             $artifactFile->setCategorySymbol($i['category_symbol']);
             $artifactFile->setFilepath('zgrane');
             $artifactFile->setStatus(1);
             $artifactFile->setPhotoNumber($i['photo_number']);
             $artifactFile->setFilesArray($artifactModel->getInventoryNumber($i['inventory_number']));
             $em->persist($artifactFile);
         }
        if (!$artifact) {
             echo 'A tego nie ma';
        }
            
        $this->addFlash('success','Zaimportowano plik: ');    
        }
        $em->flush();
        return $this->render('McvAdminBundle:catalog:imported.files.html.twig');
        
    }
 
    
}
