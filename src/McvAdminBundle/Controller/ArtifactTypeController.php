<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\ArtifactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Artifacttype controller.
 *
 * @Route("artifact-type")
 */
class ArtifactTypeController extends Controller
{
    /**
     * Lists all artifactType entities.
     *
     * @Route("/", name="artifact-type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artifactTypes = $em->getRepository('McvAdminBundle:ArtifactType')->findAll();

        return $this->render('artifacttype/index.html.twig', array(
            'artifactTypes' => $artifactTypes,
        ));
    }

    /**
     * Creates a new artifactType entity.
     *
     * @Route("/new", name="artifact-type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $artifactType = new Artifacttype();
        $form = $this->createForm('McvAdminBundle\Form\ArtifactTypeType', $artifactType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artifactType);
            $em->flush();

            return $this->redirectToRoute('artifact-type_show', array('id' => $artifactType->getId()));
        }

        return $this->render('artifacttype/new.html.twig', array(
            'artifactType' => $artifactType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a artifactType entity.
     *
     * @Route("/{id}", name="artifact-type_show")
     * @Method("GET")
     */
    public function showAction(ArtifactType $artifactType)
    {
        $deleteForm = $this->createDeleteForm($artifactType);

        return $this->render('artifacttype/show.html.twig', array(
            'artifactType' => $artifactType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing artifactType entity.
     *
     * @Route("/{id}/edit", name="artifact-type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArtifactType $artifactType)
    {
        $deleteForm = $this->createDeleteForm($artifactType);
        $editForm = $this->createForm('McvAdminBundle\Form\ArtifactTypeType', $artifactType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artifact-type_edit', array('id' => $artifactType->getId()));
        }

        return $this->render('artifacttype/edit.html.twig', array(
            'artifactType' => $artifactType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a artifactType entity.
     *
     * @Route("/{id}", name="artifact-type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ArtifactType $artifactType)
    {
        $form = $this->createDeleteForm($artifactType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artifactType);
            $em->flush();
        }

        return $this->redirectToRoute('artifact-type_index');
    }

    /**
     * Creates a form to delete a artifactType entity.
     *
     * @param ArtifactType $artifactType The artifactType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ArtifactType $artifactType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('artifact-type_delete', array('id' => $artifactType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
