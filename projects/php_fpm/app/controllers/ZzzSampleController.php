<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model;

class ZzzSampleController extends ControllerBase
{
    public function ApiAction(string $param = '', ?string $param2 = null, ?string $param3 = null)
    {
        if ($param === '400') {
            return ResponseUtil::setup400_BadRequest(new ErrorDto($param2, $param3), 'this is result');
        }
        if ($param === '403') {
            return ResponseUtil::setup403_Forbidden();
        }
        if ($param === '500') {
            return ResponseUtil::setup500_InternalServerError($param2 ?? '');
        }
        $result = new class
        {
            public $foo = 'FOOOOOOOO!';
            public $bar = 'BARRRRRRR!';
        };
        return ResponseUtil::setup200_OK($result);
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar('zzz_sample', new ZzzSample());
    }

    /**
     * Searches for zzz_sample
     */
    public function searchAction()
    {
        $numberPage = $this->request->getQuery('page', 'int', 1);
        $parameters = Criteria::fromInput($this->di, 'ZzzSample', $_GET)->getParams();
        $parameters['order'] = "zzz_sample_id";

        $paginator   = new Model(
            [
                'model'      => 'ZzzSample',
                'parameters' => $parameters,
                'limit'      => 10,
                'page'       => $numberPage,
            ]
        );

        $paginate = $paginator->paginate();

        if (0 === $paginate->getTotalItems()) {
            $this->flash->notice("The search did not find any zzz_sample");

            $this->dispatcher->forward([
                "controller" => "zzz_sample",
                "action" => "index"
            ]);

            return;
        }

        $this->view->page = $paginate;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->setVar('zzz_sample', new ZzzSample());
    }

    /**
     * Edits a zzz_sample
     *
     * @param string $zzz_sample_id
     */
    public function editAction($zzz_sample_id)
    {
        if (!$this->request->isPost()) {
            $zzz_sample = ZzzSample::findFirstByzzz_sample_id($zzz_sample_id);
            if (!$zzz_sample) {
                $this->flash->error("zzz_sample was not found");

                $this->dispatcher->forward([
                    'controller' => "zzz_sample",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->zzz_sample_id = $zzz_sample->zzz_sample_id;
            $this->view->setVar('zzz_sample', $zzz_sample);

            //$assignTagDefaults$
        }
    }

    /**
     * Creates a new zzz_sample
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'index'
            ]);

            return;
        }

        $zzz_sample = new ZzzSample();
        $zzz_sample->zzz_sample_id = (int)$this->request->getPost("zzz_sample_id");
        $zzz_sample->zzz_sample_cd = $this->request->getPost("zzz_sample_cd");
        $zzz_sample->name = $this->request->getPost("name");
        $zzz_sample->kind = $this->request->getPost("kind");
        // $zzz_sample->lock_version = (int)$this->request->getPost("lock_version");
        // $zzz_sample->created_at = $this->request->getPost("created_at");
        // $zzz_sample->created_by = (int)$this->request->getPost("created_by");
        // $zzz_sample->updated_at = $this->request->getPost("updated_at");
        // $zzz_sample->updated_by = (int)$this->request->getPost("updated_by");


        if (!$zzz_sample->create()) {
            foreach ($zzz_sample->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("zzz_sample was created successfully");

        $this->dispatcher->forward([
            'controller' => "zzz_sample",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a zzz_sample edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'index'
            ]);

            return;
        }

        $zzz_sample_id = $this->request->getPost("zzz_sample_id");
        $zzz_sample = ZzzSample::findFirstByzzz_sample_id($zzz_sample_id);

        if (!$zzz_sample) {
            $this->flash->error("zzz_sample does not exist " . $zzz_sample_id);

            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'index'
            ]);

            return;
        }

        $zzz_sample->zzz_sample_id = (int)$this->request->getPost("zzz_sample_id");
        $zzz_sample->zzz_sample_cd = $this->request->getPost("zzz_sample_cd");
        $zzz_sample->name = $this->request->getPost("name");
        $zzz_sample->kind = $this->request->getPost("kind");
        $zzz_sample->lock_version = (int)$this->request->getPost("lock_version");
        $zzz_sample->created_at = $this->request->getPost("created_at");
        $zzz_sample->created_by = (int)$this->request->getPost("created_by");
        $zzz_sample->updated_at = $this->request->getPost("updated_at");
        $zzz_sample->updated_by = (int)$this->request->getPost("updated_by");


        if (!$zzz_sample->update()) {

            foreach ($zzz_sample->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'edit',
                'params' => [$zzz_sample->zzz_sample_id]
            ]);

            return;
        }

        $this->flash->success("zzz_sample was updated successfully");

        $this->dispatcher->forward([
            'controller' => "zzz_sample",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a zzz_sample
     *
     * @param string $zzz_sample_id
     */
    public function deleteAction($zzz_sample_id)
    {
        $zzz_sample = ZzzSample::findFirstByzzz_sample_id($zzz_sample_id);
        if (!$zzz_sample) {
            $this->flash->error("zzz_sample was not found");

            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'index'
            ]);

            return;
        }

        if (!$zzz_sample->delete()) {

            foreach ($zzz_sample->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zzz_sample",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("zzz_sample was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "zzz_sample",
            'action' => "index"
        ]);
    }
}
