<?php

namespace Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Entity\IdealTrends;

/**
 * Sample controller
 *
 */
class IdealTrendsController implements ControllerProviderInterface
{

    /**
     * Route settings
     *
     */
    public function connect(Application $app)
    {
        $indexController = $app['controllers_factory'];
        $indexController->get("/", array($this, 'index'))->bind('IdealTrends_index');
        $indexController->get("/show/{id}", array($this, 'show'))->bind('IdealTrends_show');
        $indexController->get("/showTitle/{title}", array($this, 'showTitle'))->bind('IdealTrends_show_title');
        $indexController->match("/create", array($this, 'create'))->bind('IdealTrends_create');
        $indexController->match("/update/{id}", array($this, 'update'))->bind('IdealTrends_update');
        $indexController->get("/delete/{id}", array($this, 'delete'))->bind('IdealTrends_delete');
        return $indexController;
    }

    /**
     * List all entities
     *
     */
    public function index(Application $app, Request $request)
    {

        $em = $app['orm.em'];
        $entities = $em->getRepository('Entity\IdealTrends')->findAll();


        return $app['twig']->render('IdealTrends/index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Show entity
     *
     */
    public function show(Application $app, $id)
    {

        $em = $app['orm.em'];
        $entity = $em->getRepository('Entity\IdealTrends')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id ' . $id);
        }

        return $app['twig']->render('IdealTrends/show.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * Show entity for title
     *
     */
    public function showTitle(Application $app, $title)
    {
        $em = $app['orm.em'];
        $entity = $em->getRepository('Entity\IdealTrends')->obterPorTitulo($title);

        if (!$entity) {
            $app->abort(404, 'No entity found for title ' . $title);
        }

        return $app['twig']->render('IdealTrends/showTitle.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * Create entity
     *
     */
    public function create(Application $app, Request $request)
    {
        if ($request->request->get('title')) {
            $entity = new IdealTrends();
            $em = $app['orm.em'];

            $entity->setTitle($request->request->get('title'));

            $em->persist($entity);
            $em->flush();
            return $app->redirect($app['url_generator']->generate('IdealTrends_show', array('id' => $entity->getId())));
        }

        return $app['twig']->render('IdealTrends/create.html.twig');
    }

    /**
     * Update entity
     *
     */
    public function update(Application $app, Request $request, $id)
    {
        $em = $app['orm.em'];
        $entity = $em->getRepository('Entity\IdealTrends')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id ' . $id);
        }

        if ($request->request->get('title')) {
            $entity->setTitle($request->request->get('title'));
            $em->flush();
            $app['session']->getFlashBag()->add('success', 'Entity update successfull!');

            return $app->redirect($app['url_generator']->generate('IdealTrends_show', array('id' => $entity->getId())));
        }

        return $app['twig']->render('IdealTrends/update.html.twig', array(
            'entity' => $entity,
        ));
    }

    /**
     * Delete entity
     *
     */
    public function delete(Application $app, $id)
    {

        $em = $app['orm.em'];
        $entity = $em->getRepository('Entity\IdealTrends')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id ' . $id);
        }

        $em->remove($entity);
        $em->flush();

        return $app->redirect($app['url_generator']->generate('IdealTrends_index'));
    }
}