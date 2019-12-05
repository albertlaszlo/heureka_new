<template>
    <div>
        Summary {{ $route.params.id }}

        <pre>
            {{ summary }}
        </pre>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "app",
  data() {
    return {
        summary: {},
    }
  },
  async mounted() {
    const res = await axios.get(`/reservations/${this.$route.params.id}`, this.form);
    this.summary = res.data;
  },
  components: {
  },
  methods: {
  },
}
</script>

<style>
</style>