<template>
  <div>
    <ul class="nav nav-tabs">
      <li
        class="nav-item"
        v-for="(oTab, iIndex) in aTabs"
        :key="iIndex"
        @click.prevent="this.verifySelected(oTab, iIndex)"
      >
        <router-link
          class="nav-link"
          :class="{ active: currentTab === iIndex }"
          :to="oTab.link"
        >
          {{ oTab.label }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "NavBar",
  data() {
    return {
      currentTab: 0,
      selected: "/index",
      aTabs: [
        {
          label: "Create Todo",
          link: "/index",
        },
        {
          label: "Todo List",
          link: "/list/all",
        }
      ],
    };
  },
  methods: {
    verifySelected(oTab, iIndex) {
      this.currentTab = iIndex;
      this.selected = oTab.link;
    },
  },
  watch: {
    $route: {
      handler: function (sRouteValue) {
        this.selected =
          sRouteValue.path !== null || sRouteValue.path !== undefined
            ? sRouteValue.path
            : "/index";
      },
    },
  },
};
</script>
