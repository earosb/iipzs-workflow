<template>
    <span :class="['label','label-' + this.color]"><slot></slot></span>
</template>

<script>
    export default {
        props: {
            color: {
                type: String,
                required: true,
            }
        }
    }
</script>
