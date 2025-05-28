import { createAPI } from './apiFactory.js';
// export es necesaria para que este módulo pueda ser importado en otros archivos
// el equivalente en C seria `extern`
// el equivalente en Java seria `public`
export const studentsAPI = createAPI('students');
/*
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
*/
