import {listarContatos} from './fetcher.js';
let div = document.querySelector('#contatos');

listarContatos().then(conteudo=> {
    if (!conteudo.sucesso)
        throw new Error('Falha ao carregar contatos');
    conteudo.conteudoResposta.forEach(i => {
        let divList = document.createElement('div')
        let ul = document.createElement('ul');
        ul.classList.add('list-group');
        let li = document.createElement('li');
        li.classList.add('list-group-item','col', 'col-md-2' );
        let nome = document.createTextNode(i.nome);

        let email = document.createTextNode(i.email);
        let liEmail = document.createElement('li');
        console.log(i);

        li.appendChild(nome);
        liEmail.appendChild(email);
        ul.appendChild(li, liEmail);
        divList.appendChild(li, liEmail)

        div.appendChild(divList);
    })
});
