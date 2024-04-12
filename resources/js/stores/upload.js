import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useUploadStore = defineStore('upload', () => {

    const percent = ref(0)

    return {
        percent,
    }
})
