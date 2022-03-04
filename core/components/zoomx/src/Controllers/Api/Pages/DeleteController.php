<?php

namespace Zoomx\Controllers\Api\Pages;

class DeleteController extends BaseController
{
    public function index($id)
    {
        if ((int)$id === 1) {
            return jsonx([
                'success' => false,
                'message' => 'Ресурс с Id 1 удалять запрещено'
            ], [], 403);
        }

        /** @var \modResource $page */
        $page = $this->modx->getObject(\modResource::class, ['id' => $id]);

        if (!$page) {
            return jsonx([
                'success' => false,
                'message' => "Ресурс с Id {$id} не найден"
            ], [], 404);
        }

        $page->remove();

        return jsonx([
            'message' => "Ресурс с Id {$id} удален"
        ], [], 200);
    }
}
