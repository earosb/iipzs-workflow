<template>
    <input type="file" accept="*" @change="onChange">
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if (!e.target.files.length) return;

                let file = e.target.files[0];

                this.$emit('loaded', {file});
            }
        }
    }
</script>
