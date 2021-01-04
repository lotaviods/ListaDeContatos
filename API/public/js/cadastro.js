export function cadastrarContato(nome, email, numero){
    const Json = JSON.stringify({
        nome: nome,
        email: email,
        numero: numero
    })
    return fetch('http://localhost:3000/contatos/',{
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
        body: Json

    }).then(resp=>{
        return resp.body
    })

}