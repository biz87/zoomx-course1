<?php

namespace Zoomx\Controllers\Api\Pages;

class UpdateController extends BaseController
{
    public function index($id)
    {
        $request = file_get_contents("php://input");
        $data = json_decode($request, 1);


        $pagetitle = filter_var($data['pagetitle'], FILTER_SANITIZE_STRING);
        $template = (int)$data['template'];

        if (empty($pagetitle) || empty($template) || empty($id)) {
            return jsonx([
                'message' => 'Не заполнены обязательные поля',
            ], [], 400);
        }

        $isExists = $this->isExists($pagetitle, $id);
        if ($isExists) {
            return jsonx([
                'success' => false,
                'message' => 'Страница с таким заголовком уже существует',
            ], [], 400);
        }

        $response = $this->update([
            'pagetitle' => $pagetitle,
            'template' => $template,
            'id' => $id
        ]);

        $responseCode = $response['success'] ? 201 : 400;

        return jsonx([
            $response,
        ], [], $responseCode);
    }

    private function isExists($pagetitle, $id)
    {
        $count = $this->modx->getCount(\modResource::class, [
            'pagetitle' => $pagetitle,
            'deleted' => 0,
            'id:!=' => $id
        ]);

        return $count > 0;
    }

    private function update($data)
    {
        $data['published'] = 1;
        $data['context_key'] = 'web';
        $data['class_key'] = 'modResource';

        $response = $this->modx->runProcessor('resource/update', $data);
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
