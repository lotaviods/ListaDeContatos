export function listarContatos(){
    try{
        return fetch('http://localhost:3000/api/contatos/',{
            method: 'GET'
        }).then(resp=> {
            return resp.json()
        }).then(json=>{
            return json;
        })
    }catch (Error){
    console.log('Falha')
    }


}
