<template>
    <div>
        <v-select v-model="mutatedModel" :options="options" :multiple="multiple"></v-select>
        <input type="hidden" :name="name" :value="getSelectedValues">
    </div>
</template>

<script>
    import vSelect from 'vue-select';

    export default {
        components: {vSelect},
        props: ['name', 'options', 'multiple', 'selected'],
        data() {
            return {
                mutatedModel: this.selected,
            };
        },
        computed: {
            getSelectedValues: function () {

                if (!Array.isArray(this.mutatedModel)) {
                    return this.mutatedModel;
                }

                return this.mutatedModel
                    .map(item => {
                        return item.value
                    })
                    .join();
            }
        }
    }
</script>