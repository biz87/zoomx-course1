const api = {
    async getPage(id) {
        api.clearResponse();
        const response = await request.get('pages/' + id);
        api.showResponse(response)
    },

    async removePage(id) {
        api.clearResponse();
        const response = await request.delete('pages/' + id);
        api.showResponse(response)
    },

    async addPage() {
        api.clearResponse();

        const $newPageForm = document.querySelector('#newPageForm');
        if ($newPageForm) {
            const formData = new FormData($newPageForm)
            const response = await request.post('pages/', formData);
            api.showResponse(response)
        }
    },

    async getForEdit(id) {
        api.clearResponse();
        const response = await request.get('pages/' + id);
        if (response.success === false) {
            api.showResponse(response)
        }

        if (response.success === true) {
            const $changePageForm = document.querySelector('#changePageForm');
            if ($changePageForm) {
                $changePageForm.id.value = response.data.id
                $changePageForm.pagetitle.value = response.data.pagetitle
                $changePageForm.template.value = response.data.template
            }
        }
    },

    async changePage() {
        api.clearResponse();

        const $changePageForm = document.querySelector('#changePageForm');
        if ($changePageForm) {
            const id = $changePageForm.id.value
            const pagetitle = $changePageForm.pagetitle.value
            const template = $changePageForm.template.value
            const response = await request.put('pages/' + id, {pagetitle, template});
            api.showResponse(response)
        }
    },

    clearResponse() {
        const $responseCode = document.querySelector('#response-code');
        if ($responseCode) {
            $responseCode.classList.remove('pretty')
            $responseCode.innerHTML = '';
        }
    },

    showResponse(response) {
        const $responseCode = document.querySelector('#response-code');
        if ($responseCode) {
            $responseCode.classList.add('pretty')
            $responseCode.innerHTML = JSON.stringify(response, null, 2);
        }

    },
};