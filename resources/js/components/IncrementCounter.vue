<script setup>
import {ref} from "vue";

const i = ref(0)
</script>

<template>
<div class="w-[400px] mx-auto bg-amber-100">
{{i}}
</div>
    <button @click="i++">
        Click
    </button>
</template>

<style scoped>

</style>
