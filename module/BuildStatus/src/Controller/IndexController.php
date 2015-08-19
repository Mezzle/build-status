<?php

namespace BuildStatus\Controller;

use Github\Client;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 * IndexController
 *
 * @package BuildStatus\Controller
 * @author Martin Meredith <martin@sourceguru.net>
 * @copyright 2015 Martin Meredith
 */
class IndexController extends AbstractActionController
{
    /**
     * indexAction
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    public function jsonAction()
    {
        $config = $this->getServiceLocator()->get('config')['github'];

        $github = new Client();

        $github->authenticate($config['token'], null, Client::AUTH_HTTP_TOKEN);

        $branches = $github->repositories()->branches($config['username'], $config['repository']);

        $build_stats = [];

        foreach ($branches as $branch) {
            $stats = [];

            $combined = $github->repositories()
                ->statuses()
                ->combined(
                    $config['username'],
                    $config['repository'],
                    $branch['commit']['sha']
                );

            $stats['state'] = $combined['state'];

            foreach ($combined['statuses'] as $status) {
                $stats['contexts'][$status['context']] = $status['state'];
            }

            $build_stats[$branch['name']] = $stats;
        }

        $view_model = new JsonModel();
        $view_model->setVariable('builds', $build_stats);

        return $view_model;
    }
}
