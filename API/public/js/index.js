import { listarContatos } from './req/fetcher.js';
import { excluir } from "./req/remove.js";
const  tbody = document.querySelector("#lista_contatos");
const mensagem_erro = document.querySelector('#erro');

listarContatos().then(conteudo => {
    if (!conteudo.sucesso) {
        mensagem_erro.innerHTML = `Ocorreu um erro ${conteudo.conteudoResposta.mensagem}`;
        mensagem_erro.classList.add('fade-in');
        mensagem_erro.classList.remove('invisible');
        setTimeout(function () {
            mensagem_erro.classList.remove('fade-in');
            mensagem_erro.classList.add('fade-out');
            setTimeout(function () {
                mensagem_erro.classList.add('invisible');
            }, 5000);
        }, 5000);
    } else {
       if (!conteudo.conteudoResposta.length){
            mensagem_erro.innerHTML = `Não existe nenhum contato`
            mensagem_erro.classList.add('fade-in');
            mensagem_erro.classList.remove('invisible');
        setTimeout(function () {
            mensagem_erro.classList.remove('fade-in');
            mensagem_erro.classList.add('fade-out');
            setTimeout(function () {
                mensagem_erro.classList.add('invisible');
            }, 5000);
        }, 5000);
       }
        conteudo.conteudoResposta.forEach(i => {

            let tr =document.createElement("tr");
            tr.id=`id_contato_${i.id}`;
            tr.classList.add('contatos');

            let td = document.createElement('td');

            let td2 = document.createElement('td');

            let td3 = document.createElement('td');


            let button = document.createElement('button');
            button.classList.add('btn', 'btn-danger')


            let nome = document.createTextNode(i.nome);
            let email = document.createTextNode(i.email);
            let numero = document.createTextNode(i.numero);
            let nomeDoBotao = document.createTextNode('X');

            button.addEventListener("click", f => {
                excluir(i.id).then(suc => {
                    let removido = document.querySelector(`#id_contato_${i.id}`)
                    confirmacao(`#id_contato_${i.id}`);
                    setTimeout(function (){
                        removido.remove();
                    },500)

                });

            })

            td.appendChild(nome);
            td2.appendChild(numero);
            td3.appendChild(email);
            button.appendChild(nomeDoBotao);

            tr.appendChild(td);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(button);

            tbody.appendChild(tr);
        });
    }
});

function confirmacao(id) {
    var resposta = confirm("Deseja remover esse registro?");
    if (resposta == true) {
    }
}
