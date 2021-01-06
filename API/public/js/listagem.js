import {listarContatos} from './fetcher.js';

let tr = document.querySelector('#tr');

listarContatos().then(conteudo=> {
    if (!conteudo.sucesso)
        throw new Error('Falha ao carregar contatos');
    conteudo.conteudoResposta.forEach(i => {

        let tr2 = document.createElement('tr');
        let thead = document.createElement('thead');

        let td = document.createElement('th');
        td.classList.add('scope="col"');

        let td2 = document.createElement('th');
        td2.classList.add('scope="col"');

        let td3 = document.createElement('th');
        td3.classList.add('scope="col"');


        let nome = document.createTextNode(i.nome);
        let email = document.createTextNode(i.email);
        let numero = document.createTextNode(i.numero);

        td.appendChild(nome);
        td2.appendChild(email);
        td3.appendChild(numero);

        tr.appendChild(thead);
        thead.appendChild(tr2);
        tr2.appendChild(td);
        tr2.appendChild(td2);
        tr2.appendChild(td3);

    });
});
