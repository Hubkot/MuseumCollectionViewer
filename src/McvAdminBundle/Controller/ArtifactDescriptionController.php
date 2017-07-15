<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\ArtifactDescription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Artifactdescription controller.
 *
 * @Route("artifact-description")
 */
class ArtifactDescriptionController extends Controller
{
    /**
     * Lists all artifactDescription entities.
     *
     * @Route("/", name="artifact-description_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artifactDescriptions = $em->getRepository('McvAdminBundle:ArtifactDescription')->findAll();

        return $this->render('artifactdescription/index.html.twig', array(
            'artifactDescriptions' => $artifactDescriptions,
        ));
    }

    /**
     * Creates a new artifactDescription entity.
     *
     * @Route("/new", name="artifact-description_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $artifactDescription = new Artifactdescription();
        $form = $this->createForm('McvAdminBundle\Form\ArtifactDescriptionType', $artifactDescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artifactDescription);
            $em->flush();

            return $this->redirectToRoute('artifact-description_show', array('id' => $artifactDescription->getId()));
        }

        return $this->render('artifactdescription/new.html.twig', array(
            'artifactDescription' => $artifactDescription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a artifactDescription entity.
     *
     * @Route("/{id}", name="artifact-description_show")
     * @Method("GET")
     */
    public function showAction(ArtifactDescription $artifactDescription)
    {
        $deleteForm = $this->createDeleteForm($artifactDescription);

        return $this->render('artifactdescription/show.html.twig', array(
            'artifactDescription' => $artifactDescription,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing artifactDescription entity.
     *
     * @Route("/{id}/edit", name="artifact-description_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArtifactDescription $artifactDescription)
    {
        $deleteForm = $this->createDeleteForm($artifactDescription);
        $editForm = $this->createForm('McvAdminBundle\Form\ArtifactDescriptionType', $artifactDescription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artifact-description_edit', array('id' => $artifactDescription->getId()));
        }

        return $this->render('artifactdescription/edit.html.twig', array(
            'artifactDescription' => $artifactDescription,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a artifactDescription entity.
     *
     * @Route("/{id}", name="artifact-description_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ArtifactDescription $artifactDescription)
    {
        $form = $this->createDeleteForm($artifactDescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artifactDescription);
            $em->flush();
        }

        return $this->redirectToRoute('artifact-description_index');
    }

    /**
     * Creates a form to delete a artifactDescription entity.
     *
     * @param ArtifactDescription $artifactDescription The artifactDescription entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ArtifactDescription $artifactDescription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('artifact-description_delete', array('id' => $artifactDescription->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
