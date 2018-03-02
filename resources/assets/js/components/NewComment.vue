<template>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="form-group" v-show="!show">
                    <label for="flag-input" class="sr-only">Comentario</label>
                    <input id="flag-input" class="form-control" placeholder="Dejar un comentario"
                           v-on:click="toggle">
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
