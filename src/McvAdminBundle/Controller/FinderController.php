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
    public function importAllAction(Request $request){
        
        $bag = $request->getSession()->get('Wyszukane');
        
        
        if($bag){
            $this->importFilesFromBag($bag);
//            $request->getSession()->clear();
            }
        return $this->render('McvAdminBundle:catalog:imported.files.html.twig');
        
    }
       public function importFilesFromBag($bag){
        $em = $this->getDoctrine()->getManager();
        foreach ($bag as $i){
            echo'Próbuję otworzyć worek <br />';
            $findedArtifact = $em->getRepository('McvAdminBundle:Artifact')->findOneBy(array('inventoryNumber'=>$i['inventory_number']));
            if ($findedArtifact){
                echo 'Probuje zapisac plik do bazy';
                $fileModel = $this->saveFileToDb($i, $findedArtifact);
                $em->persist($fileModel);
                $em->flush();
            }
            else{
                echo 'Nie znalazlem numeru inv : to tworzę <br />';
                $this->createArtifact($em, $i['inventory_number']);
                echo 'Stworzylem teraz znow go szukam <br />';
                $findedArtifact = $em->getRepository('McvAdminBundle:Artifact')->findOneBy(array('inventoryNumber'=>$i['inventory_number']));
                echo $findedArtifact ? 'znalazlem <br />' : 'nadal go nie znalazlem <br />';
                $artifactObject = $em->find('McvAdminBundle:Artifact', $findedArtifact);
                $fileModel = $this->saveFileToDb($i, $artifactObject);
                $em->persist($fileModel);
                $em->flush();
            }
        }
    }
     /**
     * Helper Function (if $artifact inventory_number is not in Db)
     * @param type $array
     * @param Artifact $artifact
     * @return ArtifactFiles
     */
    public function createArtifact($em, $inventoryNumber){
        $artifact = new Artifact();
        $artifact->setInventoryNumber($inventoryNumber);
        $em->persist($artifact);
        $em->flush();
    }
    
    /**
     * Helper Function
     * @param type $array
     * @param Artifact $artifact
     * @return ArtifactFiles
     */
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
    
    public function checkIfFileExistInDb($em, $filename)
    {
        $findedFile = $em->getRepository('McvAdminBundle:ArtifactFiles')->findOneBy(array('filename'=>$filename));
        return $findedFile ? true : false;
    }
    
 
    
}
