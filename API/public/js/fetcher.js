<<<<<<< HEAD
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
=======
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
>>>>>>> d38097cbe6eec66dc1b0c4968db54a8135c2beca
