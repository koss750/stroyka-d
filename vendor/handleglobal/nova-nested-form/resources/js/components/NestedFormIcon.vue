<template>
    <div
        :class="`hover:border-${hoverColor} hover:text-${hoverColor}`"
        class="block text-80 flex items-center justify-center h-8 w-8"
        @click="$emit('click')"
    >
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        hoverColor: {
            type: String,
        },
    },
};
</script>
