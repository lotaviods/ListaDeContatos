<<<<<<< HEAD:API/public/js/listagem.js
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
=======
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
>>>>>>> d38097cbe6eec66dc1b0c4968db54a8135c2beca:public/js/listagem.js
})