import Swal from "sweetalert2";
import axios from "axios";

export function showAlert(message, icon){
    Swal.fire({
        title:message,
        icon:icon,
        customClass:{confirmButton:'btn btn-primary', popup:'animated zoomIn'},
        buttonsStyling: false
        }
    );
}

export function deleteConfirm(id){

    const swalWithBootstrapButton = Swal.mixin({
        customClass:{confirmButton: 'btn btn-success me-3', cancelButton:'btn btn-danger'},
        buttonsStyling:false
    });
    swalWithBootstrapButton.fire({
        title: 'Are you sure to delete the Todo?',
        icon: "question",
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Delete',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancel'
    }).then(result => {
        if (result.isConfirmed){
            axios.delete('http://localhost:250/api/v1/to_dos/'+id,
                {headers:{Authorization: 'Bearer '+localStorage.jwt}}
        ).then(response => {
            showAlert('Todo deleted', 'error');
            window.setTimeout(function (){
                window.location.href = '/home'
            }, 1000)
            })
        } else {
            showAlert('Operation cancelled', 'info')
        }
    })
}



