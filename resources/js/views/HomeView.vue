<script setup>
import {onMounted, ref} from "vue";
import {useUploadStore} from "@/stores/upload.js";
import {mdiAlphaXCircle, mdiChartTimelineVariant} from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import CardBox from '@/components/CardBox.vue'
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue'
import SectionTitleLineWithButton from '@/components/SectionTitleLineWithButton.vue'
import CardBoxComponentTitle from "@/components/CardBoxComponentTitle.vue";
import CardBoxComponentBody from "@/components/CardBoxComponentBody.vue";
import FormFilePicker from "@/components/FormFilePicker.vue";
import BaseButton from "@/components/BaseButton.vue";
import {uploadFile} from "@/helpers/index.js";

const uploadStore = useUploadStore();

const file = ref(null);
const tasks =  ref([]);
import { v4 as uuidv4 } from 'uuid';
import axios from "axios";
import TableTasks from "@/components/TableTasks.vue";

const uuid =uuidv4();

const isUploading = ref(false);

const cancel = () => {
    file.value = null
}

const submit = () => {

    isUploading.value = true;

    uploadFile(file.value, '/api/v1/upload', uploadStore, uuid)
        .then(res => {
        })
        .catch(err => {
            console.log('Error: ', err)
        })
        .finally(() => {
            isUploading.value = false;
            file.value = null;
        })

    setTimeout(() => {
        getTasks();
    }, 5000)
}


onMounted(() => {
    getTasks();
})

const getTasks = () => {
    axios.get('/api/v1/import-tasks')
        .then(res => {
            tasks.value = res.data.data;
        })
}
</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiChartTimelineVariant" title="Dashboard" main>
                <div></div>
            </SectionTitleLineWithButton>

            <CardBox>
                <CardBoxComponentTitle title="Uploading a .css"/>
                <CardBoxComponentBody>
                    <div class="relative flex gap-x-3">
                        <FormFilePicker
                            label="З файлу"
                            accept="text/csv"
                            :model-value="file"
                            @update:model-value="val => {file = val}"
                        />
                        <template v-if="file && !isUploading">
                            <BaseButton
                                @click.prevent="submit"
                                color="info"
                                class="ml-auto"
                                label="Submit"
                            />
                            <BaseButton
                                @click.prevent="cancel"
                                color="warning"
                                :icon="mdiAlphaXCircle"
                            />
                        </template>
                        <div v-if="isUploading" class="absolute inset-0 bg-gray-200 z-10 opacity-80 -m-6 rounded flex items-center justify-center">
                            <div class="border-b border-blue-800 w-8 h-8 rounded-full animate-spin"></div>
                        </div>
                    </div>
                    <div class="mt-12" v-if="isUploading">
                        The file is loading, do not close the page:
                        <progress class="flex mt-4 self-center w-full" max="100" :value="uploadStore.percent">
                            {{ uploadStore.percent }}
                        </progress>
                    </div>
                </CardBoxComponentBody>
            </CardBox>
            <CardBox has-table class="mt-8" v-if="tasks.length">
                <TableTasks :tasks="tasks" />
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
