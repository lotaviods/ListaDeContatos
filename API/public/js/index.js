import { listarContatos } from './req/fetcher.js';
import { excluir } from "./req/remove.js";

const  tbody = document.querySelector("#lista_contatos");
const mensagem_erro = document.querySelector('#erro');
let naoTemNada = document.querySelector("#naoTemNada");

listarContatos().then(conteudo => {

    existeConteudo(conteudo);
    conteudo.conteudoResposta.forEach(i => {

        let tr = createElement('tr');
        addId(tr,`id_contato_${i.id}`);
        addClasse(tr,['contatos']);

        let td = createElement('td');
        let td2 = createElement('td');
        let td3 = createElement('td');

        let button = createElement('button');
        addId(button,"botao");
        addClasse(button,['btn', 'btn-danger']);

        button.addEventListener("click", f => {
            excluir(i.id).then(suc => {
                let removido = document.querySelector(`#id_contato_${i.id}`)
                confirmacao(`#id_contato_${i.id}`);
                addClasse(removido,['apaga']);
                console.log(removido);

                setTimeout(function (){
                    removido.remove();
                },500)

            });
        });

        td.appendChild(createText(i.nome));
        td2.appendChild(createText(i.email));
        td3.appendChild(createText(i.numero));
        button.appendChild(createText("X"));

        addNoElement(tr,td);
        addNoElement(tr,td2);
        addNoElement(tr,td3);

        addNoElement(tr,button);

        addNoElement(tbody,tr);
    });
});

function confirmacao(id) {
    var resposta = confirm(`Deseja remover o esse contato?`);
    if (resposta == true) {
    }
}

function createElement(elemento){
    return document.createElement(elemento);
}

function createText(text){
    return document.createTextNode(text);
}

function addClasse(text,classe){
    text.classList.add(...classe);
}
function removeClasse(text,classe){
    text.classList.remove(...classe);
}
function addId(element,nomeId){
    element.id = nomeId
}
function addNoElement(element,add){
    element.appendChild(add);
}
function existeConteudo(conteudo) {
    if (!conteudo.sucesso) {
        mensagem_erro.innerHTML = `Ocorreu um erro ${conteudo.conteudoResposta.mensagem}`;
        addClasse(mensagem_erro, ['fade-in'])
        removeClasse(mensagem_erro,['invisible']);

        setTimeout(function () {
            removeClasse(mensagem_erro,['fade-in'])
            addClasse(mensagem_erro, ['fade-out'])

            setTimeout(function () {
                addClasse(mensagem_erro,['invisible']);
            }, 500);
        }, 500);
    } else {
        if (!conteudo.conteudoResposta.length) {
            naoTemNada.remove();
            mensagem_erro.innerHTML = `Não existe nenhum contato`
            mensagem_erro.classList.add('fade-in');

            removeClasse(mensagem_erro, ['invisible']);

            setTimeout(function () {
                removeClasse(mensagem_erro, ['fade-in']);
                addClasse(mensagem_erro, ['fade-out']);
                setTimeout(function () {
                    addClasse(mensagem_erro, ['invisible']);
                }, 5000);
            }, 5000);
        }
    }
}