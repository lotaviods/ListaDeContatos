import { adiciona } from "./req/creator.js";

    formCadastro.addEventListener("submit", event => {
    event.preventDefault();
    const nome = event.target.querySelector('[data-nome]');
    const email = event.target.querySelector('[data-email]');
    const num = event.target.querySelector('[data-num]');
    let resp = adiciona(nome.value, email.value, num.value);
    resp.then(response => {
        alert(response.conteudoResposta.mensagem);
    });
});