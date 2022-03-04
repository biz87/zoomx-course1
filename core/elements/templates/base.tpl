<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{'site_url' | option}">
    <title>{'site_name' | option}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/template/css/style.css">
</head>
<body>

    <div class="container">
        <h1 class="text-center">Zoomx - Обучающий курс #1</h1>
        <hr>

        <h3 class="text-center">Управление страницами</h3>


        <table class="mt-4 table">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Шаблон</th>
                    <th>Действия</th>
                </tr>
            </thead>

            <tbody>
                {var $pages = $_modx->runSnippet('@FILE snippets/getPages.php')}
                {foreach $pages as $page}
                    <tr>
                        <td>{$page.pagetitle}</td>
                        <td>{$page.template_name}</td>
                        <td>
                            <button class="btn btn-info" onclick="api.getPage({$page.id})">Посмотреть детали</button>

                            <button class="btn btn-success" onclick="api.getForEdit({$page.id})">Изменить</button>

                            <button class="btn btn-danger" onclick="api.removePage({$page.id})">Удалить</button>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>

        <pre id="response-code"></pre>




        <div class="row ">
            <div class="col-5  my-5 py-4">
                <h3>Заполните форму для добавления новой страницы</h3>
                <form id="newPageForm">
                    <div class="mb-3">
                        <label for="addPagetitle" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="addPagetitle" name="pagetitle">
                    </div>

                    <div class="mb-3">
                        <label for="addTemplate" class="form-label">Шаблон</label>
                        <select name="template" id="addTemplate" class="form-select">
                            <option value="0">Не указан</option>
                            <option value="1">Основной</option>
                            <option value="2">Дополнительный</option>
                        </select>
                    </div>

                    <button class="btn btn-success" type="button" onclick="api.addPage()">Добавить новую страницу</button>
                </form>
            </div>

            <div class="col-2"></div>

            <div class="col-5  my-5 py-4">
                <h3>Выберите существующую страницу для ее изменения</h3>
                <form id="changePageForm">
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="changePagetitle" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="changePagetitle" name="pagetitle">
                    </div>

                    <div class="mb-3">
                        <label for="changeTemplate" class="form-label">Шаблон</label>
                        <select name="template" id="changeTemplate" class="form-select">
                            <option value="0">Не указан</option>
                            <option value="1">Начальный</option>
                            <option value="2">Дополнительный</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="button" onclick="api.changePage()">Изменить страницу</button>
                </form>
            </div>
        </div>

    </div>

    <script src="/assets/template/js/request.js"></script>
    <script src="/assets/template/js/api/api.js"></script>
</body>
</html>