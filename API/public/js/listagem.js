import {listarContatos} from './fetcher.js';
import {excluir} from "./excluir.js";

let tr = document.querySelector('#tr');

listarContatos().then(conteudo=> {
    console.log(conteudo)
    conteudo.conteudoResposta.forEach(i => {

        let tr2 = document.createElement('tr');
        tr2.id =`id_contato_${i.id}`
        let thead = document.createElement('thead');

        let td = document.createElement('th');
        td.classList.add('scope="col"');

        let td2 = document.createElement('th');
        td2.classList.add('scope="col"');

        let td3 = document.createElement('th');
        td3.classList.add('scope="col"');

        let button = document.createElement('button');
        button.classList.add('type="button"');
        button.classList.add('class="btn');
        button.classList.add('btn-danger');

        let nome = document.createTextNode(i.nome);
        let email = document.createTextNode(i.email);
        let numero = document.createTextNode(i.numero);
        let nomeDOBotao = document.createTextNode('X');

        button.addEventListener("click", f =>{
            excluir(i.id).then(suc =>{
                let removido = document.querySelector(`#id_contato_${i.id}`)
                removido.remove();
            });

        })

        td.appendChild(nome);
        td2.appendChild(email);
        td3.appendChild(numero);
        button.appendChild(nomeDOBotao);

        tr.appendChild(thead);
        thead.appendChild(tr2);
        tr2.appendChild(td);
        tr2.appendChild(td2);
        tr2.appendChild(td3);
        tr2.appendChild(button);
    })
})
