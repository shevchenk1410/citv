<template>
    <div class="row">
      <div class="col-6">
        Mostrando {{ ((modelValue - 1) * perPage + 1) }} a
        {{ modelValue * perPage > total ? total : modelValue * perPage }} de {{ total }} registros
      </div>
      <div class="col-6">
        <div class="d-flex justify-content-end mb-2">
          <ul :class="paginationClasses.ul">
            <li
              v-if="paginationLabels.first"
              :class="`${paginationClasses.li} ${hasFirst ? paginationClasses.liDisable : ''}`"
            >
              <button
                @click="first"
                :disabled="hasFirst"
                :class="`${paginationClasses.button} ${hasFirst ? paginationClasses.buttonDisable : ''}`"
                v-html="paginationLabels.first"
              ></button>
            </li>
            <li
              v-if="paginationLabels.prev"
              :class="`${paginationClasses.li} ${hasFirst ? paginationClasses.liDisable : ''}`"
            >
              <button
                @click="prev"
                :disabled="hasFirst"
                :class="`${paginationClasses.button} ${hasFirst ? paginationClasses.buttonDisable : ''}`"
                v-html="paginationLabels.prev"
              ></button>
            </li>
            <li
              v-show="rangeFirstPage !== 1"
              :class="paginationClasses.li"
            >
              <button @click="goto(1)" :class="paginationClasses.button">1</button>
            </li>
            <li
              v-show="rangeFirstPage === 3"
              :class="paginationClasses.li"
            >
              <button @click="goto(2)" :class="paginationClasses.button">2</button>
            </li>
            <li
              v-show="rangeFirstPage !== 1 && rangeFirstPage !== 2 && rangeFirstPage !== 3"
              :class="`${paginationClasses.li} ${paginationClasses.liDisable}`"
            >
              <span :class="`${paginationClasses.button} ${paginationClasses.buttonDisable}`">...</span>
            </li>
            <li
              v-for="page in range"
              :key="page"
              :class="`${paginationClasses.li} ${hasActive(page) ? paginationClasses.liActive : ''}`"
            >
              <button
                @click="goto(page)"
                :class="`${paginationClasses.button} ${hasActive(page) ? paginationClasses.buttonActive : ''}`"
              >{{ page }}</button>
            </li>
            <li
              v-show="rangeLastPage !== pageCount && rangeLastPage !== (pageCount - 1) && rangeLastPage !== (pageCount - 2)"
              :class="`${paginationClasses.li} ${paginationClasses.liDisable}`"
            >
              <span :class="`${paginationClasses.button} ${paginationClasses.buttonDisable}`">...</span>
            </li>
            <li
              v-show="rangeLastPage === (pageCount - 2)"
              :class="paginationClasses.li"
            >
              <button @click="goto(pageCount - 1)" :class="paginationClasses.button">{{ pageCount - 1 }}</button>
            </li>
            <li
              v-if="rangeLastPage !== pageCount"
              :class="paginationClasses.li"
            >
              <button @click="goto(pageCount)" :class="paginationClasses.button">{{ pageCount }}</button>
            </li>
            <li
              v-if="paginationLabels.next"
              :class="`${paginationClasses.li} ${hasLast ? paginationClasses.liDisable : ''}`"
            >
              <button
                @click="next"
                :disabled="hasLast"
                :class="`${paginationClasses.button} ${hasLast ? paginationClasses.buttonDisable : ''}`"
                v-html="paginationLabels.next"
              ></button>
            </li>
            <li
              v-if="paginationLabels.last"
              :class="`${paginationClasses.li} ${hasLast ? paginationClasses.liDisable : ''}`"
            >
              <button
                @click="last"
                :disabled="hasLast"
                :class="`${paginationClasses.button} ${hasLast ? paginationClasses.buttonDisable : ''}`"
                v-html="paginationLabels.last"
              ></button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  const rangeMax = 3;
  const defaultClasses = {
    ul: 'pagination',
    li: 'page-item',
    liActive: 'active',
    liDisable: 'disabled',
    button: 'page-link border-0',
    buttonActive: 'page-link--active',
    buttonDisable: 'page-link--disable',
  };
  const defaultLabels = {
    first: '&laquo;',
    prev: '&lsaquo;',
    next: '&rsaquo;',
    last: '&raquo;',
  };
  
  export default {
    props: {
      modelValue: {
        // current page
        type: Number,
        required: true,
      },
      total: {
        // total records
        type: Number,
        required: true,
      },
      perPage: {
        // records per page
        type: Number,
        required: true,
      },
      classes: {
        type: Object,
        default: () => ({}),
      },
      labels: {
        type: Object,
        default: () => ({}),
      },
    },
  
    data() {
      return {
        paginationClasses: {
          ...defaultClasses,
          ...this.classes,
        },
        paginationLabels: {
          ...defaultLabels,
          ...this.labels,
        },
      };
    },
  
    mounted() {
      if (this.modelValue > this.pageCount) {
        this.$emit('update:modelValue', this.pageCount);
      }
    },
  
    computed: {
      rangeFirstPage() {
        if (this.modelValue === 1) {
          return 1;
        }
  
        if (this.modelValue === this.pageCount) {
          return this.pageCount - rangeMax + 1 > 0
            ? this.pageCount - rangeMax + 1
            : 1;
        }
  
        return this.modelValue - 1;
      },
  
      rangeLastPage() {
        return Math.min(this.rangeFirstPage + rangeMax - 1, this.pageCount);
      },
  
      range() {
        let rangeList = [];
        for (let page = this.rangeFirstPage; page <= this.rangeLastPage; page++) {
          rangeList.push(page);
        }
        return rangeList;
      },
  
      hasFirst() {
        return this.modelValue === 1;
      },
  
      hasLast() {
        return this.modelValue === this.pageCount;
      },
  
      pageCount() {
        const result = Math.ceil(this.total / this.perPage);
        return result < 1 ? 1 : result;
      },
    },
  
    watch: {
      modelValue() {
        this.$emit('change');
      },
    },
  
    methods: {
      first() {
        if (!this.hasFirst) {
          this.$emit('update:modelValue', 1);
        }
      },
  
      prev() {
        if (!this.hasFirst) {
          this.$emit('update:modelValue', this.modelValue - 1);
        }
      },
  
      goto(page) {
        this.$emit('update:modelValue', page);
      },
  
      next() {
        if (!this.hasLast) {
          this.$emit('update:modelValue', this.modelValue + 1);
        }
      },
  
      last() {
        if (!this.hasLast) {
          this.$emit('update:modelValue', this.pageCount);
        }
      },
  
      hasActive(page) {
        return page === this.modelValue;
      },
    },
  };
  </script>
  