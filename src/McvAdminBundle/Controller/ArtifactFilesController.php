<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\ArtifactFiles;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Artifactfile controller.
 *
 * @Route("artifact-files")
 */
class ArtifactFilesController extends Controller
{
    /**
     * Lists all artifactFile entities.
     *
     * @Route("/", name="artifact-files_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artifactFiles = $em->getRepository('McvAdminBundle:ArtifactFiles')->findAll();

        return $this->render('artifactfiles/index.html.twig', array(
            'artifactFiles' => $artifactFiles,
        ));
    }

    /**
     * Creates a new artifactFile entity.
     *
     * @Route("/new", name="artifact-files_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $artifactFile = new ArtifactFiles();
        $form = $this->createForm('McvAdminBundle\Form\ArtifactFilesType', $artifactFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artifactFile);
            $em->flush();

            return $this->redirectToRoute('artifact-files_show', array('id' => $artifactFile->getId()));
        }

        return $this->render('artifactfiles/new.html.twig', array(
            'artifactFile' => $artifactFile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a artifactFile entity.
     *
     * @Route("/{id}", name="artifact-files_show")
     * @Method("GET")
     */
    public function showAction(ArtifactFiles $artifactFile)
    {
        $deleteForm = $this->createDeleteForm($artifactFile);

        return $this->render('artifactfiles/show.html.twig', array(
            'artifactFile' => $artifactFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing artifactFile entity.
     *
     * @Route("/{id}/edit", name="artifact-files_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArtifactFiles $artifactFile)
    {
        $deleteForm = $this->createDeleteForm($artifactFile);
        $editForm = $this->createForm('McvAdminBundle\Form\ArtifactFilesType', $artifactFile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artifact-files_edit', array('id' => $artifactFile->getId()));
        }

        return $this->render('artifactfiles/edit.html.twig', array(
            'artifactFile' => $artifactFile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a artifactFile entity.
     *
     * @Route("/{id}", name="artifact-files_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ArtifactFiles $artifactFile)
    {
        $form = $this->createDeleteForm($artifactFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artifactFile);
            $em->flush();
        }

        return $this->redirectToRoute('artifact-files_index');
    }

    /**
     * Creates a form to delete a artifactFile entity.
     *
     * @param ArtifactFiles $artifactFile The artifactFile entity
     *
     * @return Form The form
     */
    private function createDeleteForm(ArtifactFiles $artifactFile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('artifact-files_delete', array('id' => $artifactFile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
