<template>
    <div class="form-group">
        <label for="subscribers">Notificar {{ selected }}</label>
        <v-select name="subscribers" id="subscribers" :value.sync="selected" :options="options" multiple/>
    </div>
</template>
<script>
    import vSelect from "vue-select"

    export default {
        props: ['users'],

        components: {vSelect},

        data() {
            return {
                selected: null,
                options: JSON.parse(this.users)
            }
        },
        mounted(){
            console.log(this.users);
        }
    }
</script>