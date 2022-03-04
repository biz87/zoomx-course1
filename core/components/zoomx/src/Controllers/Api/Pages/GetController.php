<?php

namespace Zoomx\Controllers\Api\Pages;

use modResource;

class GetController extends BaseController
{
    public function index($id)
    {
        $page = $this->modx->getObject(modResource::class, ['id' => $id, 'deleted' => 0]);
        if ($page) {
            return jsonx([
                'id' => $page->id,
                'pagetitle' => $page->pagetitle,
                'template' => $page->template,
                'createdon' => $page->get('createdon')
            ]);
        }

        return jsonx([], [], 404);
    }
}
