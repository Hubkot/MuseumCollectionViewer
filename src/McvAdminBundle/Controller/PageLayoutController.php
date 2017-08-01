<?php

namespace McvAdminBundle\Controller;

use McvAdminBundle\Entity\PageLayout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pagelayout controller.
 *
 * @Route("page-layout")
 */
class PageLayoutController extends Controller
{
    /**
     * Lists all pageLayout entities.
     *
     * @Route("/", name="page-layout_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pageLayouts = $em->getRepository('McvAdminBundle:PageLayout')->findAll();

        return $this->render('McvAdminBundle:pagelayout:index.html.twig', array(
            'pageLayouts' => $pageLayouts,
        ));
    }

    /**
     * Creates a new pageLayout entity.
     *
     * @Route("/new", name="page-layout_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pageLayout = new Pagelayout();
        $form = $this->createForm('McvAdminBundle\Form\PageLayoutType', $pageLayout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pageLayout);
            $em->flush();

            return $this->redirectToRoute('page-layout_show', array('id' => $pageLayout->getId()));
        }

        return $this->render('McvAdminBundle:pagelayout:new.html.twig', array(
            'pageLayout' => $pageLayout,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pageLayout entity.
     *
     * @Route("/{id}", name="page-layout_show")
     * @Method("GET")
     */
    public function showAction(PageLayout $pageLayout)
    {
        $deleteForm = $this->createDeleteForm($pageLayout);

        return $this->render('McvAdminBundle:pagelayout:show.html.twig', array(
            'pageLayout' => $pageLayout,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pageLayout entity.
     *
     * @Route("/{id}/edit", name="page-layout_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PageLayout $pageLayout)
    {
        $deleteForm = $this->createDeleteForm($pageLayout);
        $editForm = $this->createForm('McvAdminBundle\Form\PageLayoutType', $pageLayout);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('page-layout_edit', array('id' => $pageLayout->getId()));
        }

        return $this->render('McvAdminBundle:pagelayout:edit.html.twig', array(
            'pageLayout' => $pageLayout,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pageLayout entity.
     *
     * @Route("/{id}", name="page-layout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PageLayout $pageLayout)
    {
        $form = $this->createDeleteForm($pageLayout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pageLayout);
            $em->flush();
        }

        return $this->redirectToRoute('page-layout_index');
    }

    /**
     * Creates a form to delete a pageLayout entity.
     *
     * @param PageLayout $pageLayout The pageLayout entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PageLayout $pageLayout)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page-layout_delete', array('id' => $pageLayout->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
