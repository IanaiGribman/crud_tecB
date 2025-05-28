export function createAPI(moduleName, config = {}) {
    const API_URL = config.urlOverride ?? `../../backend/server.php?module=${moduleName}`;


    async function sendJSON(method, data) {
        const res = await fetch(API_URL,
        {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        if (!res.ok) {
            const errorMsg = `Error en la petición HTTP (${method}): ${res.status} ${res.statusText}`;
            throw new Error(errorMsg);
        }

        return await res.json();
    }
    // este return es el objeto que se exporta y contiene las funciones para interactuar con la API
    return {
        async fetchAll(){
            const res = await fetch(API_URL);
            if (!res.ok) throw new Error("No se pudieron obtener los datos");
            return await res.json();
        },
        async create(data){
            return await sendJSON('POST', data);
        },
        async update(data){
            return await sendJSON('PUT', data);
        },
        async remove(id){
            return await sendJSON('DELETE', { id });
        }
    };
}
