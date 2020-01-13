const token = document.head.querySelector("[name~=csrf-token][content]").content;
const redirect = "/home/incidencias";

function ver(id){
    window.location = `${redirect}/ver/${id}`
  }

function eliminar (id){
    const response = fetch("/home/incidencias", {
      headers: {
     "Content-Type": "application/json",
     "Accept": "application/json, text-plain, */*",
     "X-Requested-With": "XMLHttpRequest",
     "X-CSRF-TOKEN": token
    },
        method:"POST",
        body: JSON.stringify({id:id}),
    }).then(s=> window.location.href = redirect)
    .catch(e=>console.log(e))
}

function editar(id){
    window.location = `${redirect}/${id}`
}