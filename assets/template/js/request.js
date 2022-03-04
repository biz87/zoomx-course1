const request = {
    headers: {},
    baseurl: '',
    async get(path, formData = null) {
        request.setBaseUrl()
        request.setHeaders()
        try {
            const link = this.baseurl + path
            const url = new URL(link)
            if (formData !== null) {
                url.search = new URLSearchParams(formData).toString()
            }
            const response = await fetch(url, {method: 'GET', headers: request.headers})
            return await response.json()
        } catch (e) {
            console.warn('Error', e.message)
        }
    },
    async post(path, formData = null) {
        request.setBaseUrl()
        request.setHeaders()
        try {
            const link = this.baseurl + path
            const response = await fetch(link, {
                    method: 'POST',
                    headers: request.headers,
                    body: formData
                }
            )
            return await response.json()
        } catch (e) {
            console.warn('Error', e.message)
        }
    },
    async put(path, data = {}) {
        request.setBaseUrl()
        request.setHeaders()
        try {
            const link = this.baseurl + path
            const response = await fetch(link, {
                    method: 'PUT',
                    headers: request.headers,
                    body: JSON.stringify(data)
                }
            )
            return await response.json()
        } catch (e) {
            console.warn('Error', e.message)
        }
    },
    async delete(path, formData = null) {
        request.setBaseUrl()
        request.setHeaders()
        try {
            const link = this.baseurl + path
            const url = new URL(link)
            url.search = new URLSearchParams(formData).toString()
            const response = await fetch(url, {method: 'DELETE', headers: request.headers})
            return await response.json()
        } catch (e) {
            console.warn('Error', e.message)
        }
    },
    setBaseUrl() {
        request.baseurl = 'https://zoomx-course1.megawebs.kz/api/'
    },
    setHeaders() {
        request.headers = {
            'Accept': 'application/json'
        };
    },
}