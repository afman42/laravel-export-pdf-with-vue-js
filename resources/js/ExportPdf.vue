<script setup>
import { ref } from "vue";
const props = defineProps({
    endpoint: String,
});
const formOrDownload = ref(true);
const boxHtml = ref("<h1>Hello World</h1>");
function submit(e) {
    axios
        .post(props.endpoint, {
            html: boxHtml.value,
        })
        .then((e) => {
            formOrDownload.value = false;
        })
        .catch((e) => console.log(e));
}
function backButton(e) {
    formOrDownload.value = true;
}
</script>
<template>
    <div class="d-flex flex-column">
        <div v-if="formOrDownload">
            <form @submit.prevent="submit">
                <textarea
                    v-model="boxHtml"
                    placeholder="Please fill"
                    required
                    cols="20"
                    rows="5"
                ></textarea>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
        <div v-else>
            <a class="btn btn-primary" href="/hello-world.pdf" download
                >Download</a
            >
            <button class="btn btn-danger" @click="backButton">Back</button>
        </div>
    </div>
</template>
