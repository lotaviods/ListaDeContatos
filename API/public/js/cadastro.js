export function cadastrarContato(nome, email, numero) {
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
    })
}
const formCadastro = document.querySelector('[data-form]');
formCadastro.addEventListener("submit", event => {
    event.preventDefault();
    const nome = event.target.querySelector('[data-nome]');
    const email = event.target.querySelector('[data-email]');
    const num = event.target.querySelector('[data-num]');
    cadastrarContato(nome.value, email.value, num.value);
});