<template>
    <div>
        <ul class="list-group" v-for="(attach, index) in attachments" :key="index">
            <li class="list-group-item">
                
                <i class="glyphicon glyphicon-file"></i>
                <a :href="'/' + attach.path" target="_blank">{{ attach.name }}</a>

                <input :name="'attachments[' + index + '][name]'" type="hidden" :value="attach.name">
                <input :name="'attachments[' + index + '][mime_type]'" type="hidden" :value="attach.mime_type">
                <input :name="'attachments[' + index + '][path]'" type="hidden" :value="attach.path">

                <div class="pull-right">
                    <button class="btn-link glyphicon glyphicon-remove" type="button" @click="remove(attach)"></button>
                </div>
            </li>
        </ul>

        <div class="form-group ">
            <label for="attachments">Adjuntar archivo 
                <small class="text-muted">(opcional)</small>
            </label> 
            <input class="form-control" type="file" accept="*" @change="onChange">
        </div>

    </div>
</template>

<script>
    export default {
        props: ['attach'],

        data() {
            return {
                attachments: []
            };
        },

        created(){
            if(this.attach !== null){
                this.attachments = this.attach;
            }
        },

        methods: {
            onChange(evt) {
                if (!evt.target.files.length) return;
                
                this.upload(evt.target.files[0]);
            },

            upload(attachment) {
                let data = new FormData();

                data.append('attachment', attachment);

                axios.post(`/upload`, data).then(
                    response => this.handleResponse(response),
                    error => this.handleError(error)
                );
            },

            handleResponse(response){
                flash('Archivo adjunto subido con éxito');
                this.attachments.push(response.data);
            },

            handleError(error){
                flash('Error al subir archivo', 'danger');
                console.log(error);
            },

            remove(attach){
                const index = this.attachments.indexOf(attach);
                this.attachments.splice(index, 1);
            }
        }
    }
</script>
