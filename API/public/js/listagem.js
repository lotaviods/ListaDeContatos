import {listarContatos} from './fetcher.js';
let ul = document.querySelector('#contatos');
listarContatos().then(conteudo=>{
    if (!conteudo.sucesso)
        throw new Error('Falha ao carregar contatos');
    conteudo.conteudoResposta.forEach(i =>{
        let contato = document.createElement('li');
        let nome = document.createTextNode(i.nome)
        console.log(i);
        contato.appendChild(nome);
        ul.appendChild(contato);
    })
})