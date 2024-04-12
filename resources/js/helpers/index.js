import axios from "axios";

export const uploadFile = async (file, path, uploadStore = {}, uuid) =>  {
    let size = file.size;
    let sliceSize = 1024 * 1024;

    if (size > sliceSize) {

        let formData = new FormData();
        formData.append("file", file);
        formData.append("start", 0);
        formData.append("uuid", uuid);
        formData.append("size", size);
        await axios.post(path, formData, {
            onUploadProgress: (progressEvent) => {
                let percentage = Math.round((progressEvent.loaded / size) * 100);
                console.log(`Uploaded: ${percentage}%`);
            },
        });
    } else {

        let start = 0;
        const uploadChunk = async () => {
            let end = start + sliceSize;
            if (end > file.size) {
                end = file.size;
            }
            let chunk = file.slice(start, end);
            let formData = new FormData();
            formData.append("file", chunk);
            formData.append("start", start);
            formData.append("uuid", uuid);
            formData.append("size", size);
            await axios.post(path, formData, {
                onUploadProgress: (progressEvent) => {
                    let uploaded = progressEvent.loaded + start;
                    let percentage = Math.round((uploaded / size) * 100);
                    uploadStore.percent = percentage;
                    console.log(`Uploaded: ${percentage}%`);
                },
            });
            if (end < size) {
                start = end;
                await uploadChunk();
            }
        }
        await uploadChunk();
    }
}
