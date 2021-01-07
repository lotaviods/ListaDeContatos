export function adiciona(nome, email, numero) {
    const Json = JSON.stringify({
        nome: nome,
        email: email,
        numero: numero
    })
    return fetch('http://localhost:8080/api/contatos/', {
        method: "POST",
        headers: {
            'Content-type': 'application/json'
        },
        body: Json
    }).then(resp => {
        return resp.json().then(json =>{
            return json;
        })
    }).catch(e=>{
        alert('Erro de conexão com o servidor.')
    })
}