<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\Artifact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Artifact controller.
 *
 * @Route("artifact")
 */
class ArtifactController extends Controller
{
    /**
     * Lists all artifact entities.
     *
     * @Route("/", name="artifact_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artifacts = $em->getRepository('McvAdminBundle:Artifact')->findAll();

        return $this->render('artifact/index.html.twig', array(
            'artifacts' => $artifacts,
        ));
    }

    /**
     * Creates a new artifact entity.
     *
     * @Route("/new", name="artifact_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $artifact = new Artifact();
        $form = $this->createForm('McvAdminBundle\Form\ArtifactType', $artifact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artifact);
            $em->flush();

            return $this->redirectToRoute('artifact_show', array('id' => $artifact->getId()));
        }

        return $this->render('artifact/new.html.twig', array(
            'artifact' => $artifact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a artifact entity.
     *
     * @Route("/{id}", name="artifact_show")
     * @Method("GET")
     */
    public function showAction(Artifact $artifact)
    {
        $deleteForm = $this->createDeleteForm($artifact);

        return $this->render('artifact/show.html.twig', array(
            'artifact' => $artifact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing artifact entity.
     *
     * @Route("/{id}/edit", name="artifact_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Artifact $artifact)
    {
        $deleteForm = $this->createDeleteForm($artifact);
        $editForm = $this->createForm('McvAdminBundle\Form\ArtifactType', $artifact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artifact_edit', array('id' => $artifact->getId()));
        }

        return $this->render('artifact/edit.html.twig', array(
            'artifact' => $artifact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a artifact entity.
     *
     * @Route("/{id}", name="artifact_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Artifact $artifact)
    {
        $form = $this->createDeleteForm($artifact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artifact);
            $em->flush();
        }

        return $this->redirectToRoute('artifact_index');
    }

    /**
     * Creates a form to delete a artifact entity.
     *
     * @param Artifact $artifact The artifact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Artifact $artifact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('artifact_delete', array('id' => $artifact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
