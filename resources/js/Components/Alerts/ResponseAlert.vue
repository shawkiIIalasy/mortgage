<script setup>
    defineProps({
        type: {
            type: String,
        },
        message: {
            type: String,
        },
        messages: {
            type: Array,
        }
    });
</script>

<template>
    <v-alert variant="outlined" :type="type" v-if="messages.length || message">
        <ul v-if="messages" v-for="message in messages">
            <li v-for="m in message">
                {{m}}
            </li>
        </ul>

        <span v-if="message">
            {{message}}
        </span>
    </v-alert>
</template>
