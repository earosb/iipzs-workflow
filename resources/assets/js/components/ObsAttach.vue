<template>
    <div>
        <ul class="list-group" v-for="attach in attachments">
            <li class="list-group-item">
                <input name="attachments[]" type="hidden" :value="JSON.stringify(attach)">
                <i class="glyphicon glyphicon-file"></i>
                <a :href="'/' + attach.path" target="_blank">{{ attach.name }}</a>
                <div class="pull-right">
                    <button class="btn-link glyphicon glyphicon-remove" type="button" @click="remove(attach)"></button>
                </div>
            </li>
        </ul>

        <form method="POST" enctype="multipart/form-data">
            <file-upload name="avatar" @loaded="onLoad"></file-upload>
        </form>

    </div>
</template>

<script>
    import FileUpload from './FileUpload.vue';

    export default {
        props: ['user'],

        components: {FileUpload},

        data() {
            return {
                attachments: []
            };
        },

        methods: {
            onLoad(file) {
                this.persist(file.file);
            },

            remove(attach) {
                let filename = attach.path.substring(11);
                axios.delete(`/upload${filename}`)
                    .then(response => {
                        if (response.data.deleted) {
                            flash('Archivo eliminado');
                            let index = this.attachments.indexOf(attach);
                            this.attachments.splice(index, 1);
                        } else flash('Error al eliminar archivo', 'danger');
                    });
            },

            persist(attachment) {
                let data = new FormData();

                data.append('attachment', attachment);

                axios.post(`/upload`, data)
                    .then(
                        response => {
                            this.attachments.push(response.data);
                            flash('Archivo adjunto subido!');
                        });
            }
        }
    }
</script>
