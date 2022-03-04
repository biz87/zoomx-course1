<?php

$pages = [];
/** @var modX $modx */
$q = $modx->newQuery(modResource::class);
$q->limit(10);
$q->where([
    'parent' => 0,
    'published' => 1,
    'deleted' => 0
]);


$q->leftJoin(modTemplate::class, 'Template', 'Template.id = modResource.template');
$q->groupby('modResource.id');
$q->select('modResource.id, modResource.pagetitle');
$q->select('Template.templatename as template_name');
$q->prepare();

if ($q->stmt->execute()) {
    $pages = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
}

return $pages;
