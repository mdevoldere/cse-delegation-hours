export class Ajax 
{
    static async get(_url, _json = true) {
        try {
            const r = await fetch(_url);
            console.log('fetch', _url);
            return await (_json ? r.json() : r.text());
        } catch (error) {
            console.error(error.message)
            return [];
        } 
    }

    static async post(_body = {}) {
        try {
            const r = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(_body)
            });
            return await (response.json());
        } catch (error) {
            console.error(error.message)
            return [];
        } 
    }  
}

export class AjaxDb 
{
    constructor(_url) 
    {
        this.url = _url;
        this.data = undefined;
    }

    async get(_force = false) {
        if(this.data === undefined || _force) {
            this.data = await Ajax.get(this.url);
            return this.data;
        }
        return new Promise((resolve) => resolve(this.data));
    }
}
