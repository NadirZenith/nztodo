<?php

namespace Nz\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nz\TodoBundle\Model\TodoCollection;
use Nz\TodoBundle\Entity\Todo;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;

/**
 * Rest controller for todos
 * 
 * @package Nz\TodoBundle\Controller
 * @author Nadir Zenith <2cb.md2@gmail.com>
 */
class TodoController extends FOSRestController
{

    /**
     * List all todos.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing todos.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many todos to return.")
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getTodosAction(Request $request, ParamFetcherInterface $paramFetcher)
    {

        $offset = $paramFetcher->get('offset');
        $start = null == $offset ? 0 : $offset + 1;
        $limit = $paramFetcher->get('limit');

        $todos = $this->get('nztodo.repository')->fetch($start, $limit);

        $collection = new TodoCollection($todos, $offset, $limit);
        return $collection;
    }

    /**
     * Show form to create new todo
     * 
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * 
     * @Annotations\View()
     */
    public function newTodoAction()
    {
        $form = $this->createForm('todo', null, ['intention' => 'create']);

        return $form;
    }

    /**
     * Creates a new todo from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Nz\TodoBundle\Form\Type\TodoType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *   template = "NzTodoBundle:Todo:newTodo.html.twig",
     *   statusCode = Codes::HTTP_BAD_REQUEST
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|RouteRedirectView
     */
    public function postTodosAction(Request $request)
    {
        $todo = new Todo();
        $form = $this->createForm('todo', $todo);

        $form->submit($request);

        if ($form->isValid()) {
            $this->get('nztodo.repository')->persistAndFlush($todo);
            return $this->routeRedirectView('get_todos');
        }

        return $form;
    }

    /**
     * Get a single todo.
     *
     * @ApiDoc(
     *   output = "NZ\TodoBundle\Entity\Todo",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the todo is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="todo")
     *
     * @param Request $request the request object
     * @param int     $id      the todo id
     *
     * @return array
     *
     * @throws NotFoundHttpException when todo not exist
     */
    public function getTodoAction($id)
    {
        $todo = $this->get('nztodo.repository')->find($id);

        if (!$todo) {
            throw $this->createNotFoundException("Todo does not exist.");
        }

        $view = new View($todo);
        $group = $this->container->get('security.context')->isGranted('ROLE_API') ? 'restapi' : 'standard';
        $view->getSerializationContext()->setGroups(array('Default', $group));

        return $view;
    }

    /**
     * Presents the form to use to update an existing todo.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     200 = "Returned when successful",
     *     404 = "Returned when the todo is not found"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param int     $id      the todo id
     *
     * @return FormTypeInterface
     *
     * @throws NotFoundHttpException when todo not exist
     */
    public function editTodosAction($id)
    {
        $todo = $this->get('nztodo.repository')->find($id);

        if (false === $todo) {
            throw $this->createNotFoundException("Todo does not exist.");
        }

        $form = $this->createForm('todo', $todo, ['intention' => 'edit']);
        return $form;
    }

    /**
     * Update existing todo from the submitted data
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\NoteType",
     *   statusCodes = {
     *     201 = "Returned when a new resource is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @todo nz debug this template annotation
     * 
     * @Annotations\View(
     *   template="NzTodoBundle:Todo:editTodos.html.twig",
     *   templateVar="form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the todo id
     *
     * @return FormTypeInterface|RouteRedirectView
     *
     * @throws NotFoundHttpException when todo not exist
     */
    public function putTodosAction(Request $request, $id)
    {
        $todo = $this->get('nztodo.repository')->find($id);

        if (!$todo) {
            throw $this->createNotFoundException("Todo does not exist.");
        }

        $form = $this->createForm('todo', $todo);

        $form->submit($request);
        if ($form->isValid()) {
            $this->get('nztodo.repository')->persistAndFlush($todo);

            return $this->routeRedirectView('get_todos', array(), Codes::HTTP_NO_CONTENT);
        }

        return $form;
    }

    /**
     * Removes a todo.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the todo id
     *
     * @return RouteRedirectView
     */
    public function deleteTodosAction($id)
    {
        $rep = $this->get('nztodo.repository');
        $todo = $rep->find($id);

        $rep->removeAndFlush($todo);

        return $this->routeRedirectView('get_todos', array(), Codes::HTTP_NO_CONTENT);
    }

    /**
     * Removes a todo.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the todo id
     *
     * @return RouteRedirectView
     */
    public function removeTodosAction($id)
    {
        return $this->deleteTodosAction($id);
    }
}
