document.addEventListener('DOMContentLoaded', () => {
    //Declaración de variables
    const uuid = document.querySelector('#uuid').value;
    //Verificar que el elemento de dropzone exista en el documento HTML
    if (document.querySelector('#dropzone'))
    {
        Dropzone.autoDiscover = false;
        //Creando la instancia a la clase Dropzone
        const dropzone = new Dropzone('div#dropzone', {
            url: '/imagenes/store',
            dictDefaultMessage: 'Sube hasta 10 imagenes del establecimiento',
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png, .jpg, .gif, .jpeg",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            success: function (file, respuesta) {
                //console.log(file)
                console.log(respuesta)
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', uuid);
                console.log('Enviando...')
            }
        });
    }
});
