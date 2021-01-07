export function listarContatos(){
    return fetch('http://localhost:8080/api/contatos/',{
        method: 'GET'
    })
    .then(resp=> {
        return resp.json()
    }).then(json=>{
        return json;
    })
}
