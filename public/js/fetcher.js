const promice = fetch('http://localhost:3000/api/contatos/')
const resp = promice.then(resp =>{
    return resp.json();
});
JsonData = resp.then(json =>{
    return json.conteudoResposta;
});
const tab = document.querySelector('#listaContato');

const exibeCliente = (nome, email) => {
    const tr = document.createElement('tr');

    const conteudoLinha = `
    <td>${nome}</td>
    <td>${email}</td>
    `;
    tr.innerHTML = conteudoLinha;
    return tr;
}

JsonData.forEach(i =>{
    tab.appendChild(exibeCliente(i.nome, i.email));
})