export function  excluir(id) {
    return fetch(`http://localhost:8080/api/contatos/${id}`,{
        method: 'DELETE',
        headers: {
            'Content-type': 'application/json'
        }
    }).then(resp => {
        return resp
    })
}

