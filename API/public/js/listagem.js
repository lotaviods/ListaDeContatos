import {listarContatos} from './fetcher.js';
let div = document.querySelector('#contatos');

listarContatos().then(conteudo=> {
    if (!conteudo.sucesso)
        throw new Error('Falha ao carregar contatos');
    conteudo.conteudoResposta.forEach(i => {

        let divRow = document.createElement('div');
        divRow.classList.add('col-sm');

        let ul = document.createElement('ul');
        ul.classList.add('list-group');

        let li = document.createElement('li');
        li.classList.add('list-group-item','col', 'col-md-2' );

        let nome = document.createTextNode(i.nome);
        let email = document.createTextNode(i.email);
        let numero = document.createTextNode(i.numero);

        let liEmail = document.createElement('li');
        liEmail.classList.add('list-group-item','col', 'col-md-2' );

        let ulEmail = document.createElement('ul');
        ulEmail.classList.add('list-group');

        li.appendChild(nome);
        ul.appendChild(li);
        divRow.appendChild(ul);

        div.appendChild(divRow);

        console.log(i);
        
    })

});
