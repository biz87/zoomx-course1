<?php

namespace Zoomx\Controllers\Api\Pages;

class CreateController extends BaseController
{
    public function index()
    {
        $pagetitle = filter_input(INPUT_POST, 'pagetitle', FILTER_SANITIZE_STRING);
        $template = (int)$_POST['template'];

        if (empty($pagetitle) || empty($template)) {
            return jsonx([
                'success' => false,
                'message' => 'Не заполнены обязательные поля',
            ], [], 400);
        }

        $isExists = $this->isExists($pagetitle);
        if ($isExists) {
            return jsonx([
                'success' => false,
                'message' => 'Страница с таким заголовком уже существует',
            ], [], 400);
        }

        $response = $this->create([
            'pagetitle' => $pagetitle,
            'template' => $template
        ]);

        $responseCode = $response['success'] ? 201 : 400;

        return jsonx([
            $response,
        ], [], $responseCode);
    }

    private function isExists($pagetitle)
    {
        $count = $this->modx->getCount(\modResource::class, [
            'pagetitle' => $pagetitle,
            'deleted' => 0,
        ]);

        return $count > 0;
    }

    private function create($data)
    {
        $data['published'] = 1;
        $data['context'] = 'web';
        $data['class_key'] = 'modResource';

        $response = $this->modx->runProcessor('resource/create', $data);
        if ($response->isError()) {
            $output['success'] = false;
            $this->modx->log(1, print_r($response->response, 1));
            $output['message'] = $response->response;
        } else {
            $id = $response->response['object']['id'];
            $output['id'] = $id;
            $output['success'] = true;
        }
        return $output;
    }
}
