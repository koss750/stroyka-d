<template>
  <Icon
    class="cursor-pointer"
    type="trash"
    v-if="field.children.length > field.min"
    hover-color="danger"
    @click="removeChild"
  />
</template>

<script>
import NestedFormIcon from "./NestedFormIcon";

export default {
  components: { NestedFormIcon },

  props: {
    field: {
      type: Object,
      required: true,
    },

    child: {
      type: Object,
      required: true,
    },
  },

  methods: {
    /**
     * Remove a child.
     */
    removeChild() {
      this.field.children.splice(this.field.children.indexOf(this.child), 1);
    },
  },
};
</script>
