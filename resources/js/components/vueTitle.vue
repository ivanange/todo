<template></template>

<script>
export default {
  props: ["title"],
  watch: {
    title: {
      immediate: true,
      handler() {
        document.title = this.title || "Title";
      }
    }
  },
  render() {}
};
</script>