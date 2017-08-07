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
            //TODO Poprawić aby do sesji zapisywana byla tablica asocjacyjna a nie tradycyjna
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
        if($bag){
            foreach ($bag as $i){

                $artifact = $em->getRepository('McvAdminBundle:Artifact')->findOneBy(array('inventoryNumber'=>$i['inventory_number']));
                $artifactObject = $em->find('McvAdminBundle:Artifact', $artifact);

                if($artifact){
                     echo 'Znalazłem w bazie <br />';
                     try {
                         //TODO install composer FILESYSTEM COMPONENT TO MOVE FILE FORM IMPORT FOLDER
                        $object = $this->saveFileToDb($i, $artifactObject);
                        $em->persist($object);
                        
                     } catch (Exception $ex) {
                         
                     }
                     
                     $em->flush();
                 }
                if (!$artifact) {
                     echo 'A tego nie ma <br />';
                     echo 'Podejmuję próbę dodania <br />';
                     $artifactModel = new Artifact(); 
                     $artifactModel->setInventoryNumber($i['inventory_number']);
                     $em->persist($artifactModel);
                echo 'Probuje flushnac <br />';
                $em->flush();
                echo 'Flushnieto do bazy';
                     echo 'Persist nowego obiektu wykonany <br />';
                }

                $this->addFlash('success','Zaimportowano plik: ');    
            }
            $request->getSession()->clear();
            }
        return $this->render('McvAdminBundle:catalog:imported.files.html.twig');
        
    }
    
    public function saveFileToDb($array, Artifact $artifact){
        $fileModel = new ArtifactFiles();
        $fileModel->setCategorySymbol($array['category_symbol']);
        $fileModel->setFilename($array['file_name']);
        $fileModel->setFilepath('/some_path');
        $fileModel->setPhotoNumber($array['photo_number']);
        $fileModel->setStatus(1);
        $fileModel->setFileCopyrights('SomeCopy');
        $fileModel->setFilesArray($artifact);
        return $fileModel;
    }
 
    
}
