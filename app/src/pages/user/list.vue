<template>
  <div class="q-pa-md">
    <div class="q-pa-md q-gutter-sm">
      <q-btn
        round
        color="secondary"
        icon="library_add"
        title="Novo Usuário"
        to="/usuario-form"
      />
    </div>

    <q-table
      title="Usuário"
      :data="data"
      :columns="columns"
      color="primary"
      row-key="id"
      separator="cell"
    >
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn
            title="Editar Usuário"
            type="edit"
            icon="create"
            color="primary"
            size="sm"
            dense
            :data="getDataList"
            :to="{ name: 'user_form', params: { id: props.row.id } }"
          />
          <q-btn
            title="Deletar Usuário"
            type="delete"
            icon="delete"
            color="negative"
            size="sm"
            dense
            class="q-ml-sm"
            :data="deleteData"
            @click="deleteData(props.row.id)"
          />
        </q-td>
      </template>

      <div class="q-mt-md">Selected: {{ JSON.stringify(selected) }}</div>

    </q-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      navigationActive: false,
      filter: "",
      selected: [],
      pagination: {},

      columns: [
        {
          name: "id",
          align: "centre",
          label: "ID",
          field: "id",
          sortable: true,
        },
        {
          name: "name",
          align: "centre",
          label: "Nome",
          field: "name",
          sortable: true,
        },
        {
          name: "userType_id",
          align: "centre",
          label: "Tipo",
          field: "userType_id",
          sortable: true,
        },
        {
          name: "actions",
          align: "centre",
          label: "Ações",
          field: "actions",
          sortable: true,
        },
      ],

      data: [],
    };
  },

  methods: {
    getDataList() {
      return this.$axios({
        method: "get",
        url: "http://127.0.0.1:8000/api/user",
        headers: {
          "gp-token": this.$q.sessionStorage.getItem("gp_token"),
        },
      }).then((resp) => {
        this.data = resp.data;
      });
    },
    deleteData(id) {
      return this.$axios({
        method: "delete",
        url: "http://127.0.0.1:8000/api/user/" + id,
        headers: {
          "gp-token": this.$q.sessionStorage.getItem("gp_token"),
        },
      }).then (() => {
        location.reload()
      })
    },

    getSelectedString() {
      return this.selected.length === 0
        ? ""
        : `${this.selected.length} record${
            this.selected.length > 1 ? "s" : ""
          } selected of ${this.data.length}`;
    },

    activateNavigation() {
      this.navigationActive = true;
    },

    deactivateNavigation() {
      this.navigationActive = false;
    },

    onKey(evt) {
      if (
        this.navigationActive !== true ||
        [33, 34, 35, 36, 38, 40].indexOf(evt.keyCode) === -1 ||
        this.$refs.myTable === void 0
      ) {
        return;
      }

      evt.preventDefault();

      const { computedRowsNumber, computedRows } = this.$refs.myTable;

      if (computedRows.length === 0) {
        return;
      }

      const currentIndex =
        this.selected.length > 0 ? computedRows.indexOf(this.selected[0]) : -1;
      const currentPage = this.pagination.page;
      const rowsPerPage =
        this.pagination.rowsPerPage === 0
          ? computedRowsNumber
          : this.pagination.rowsPerPage;
      const lastIndex = computedRows.length - 1;
      const lastPage = Math.ceil(computedRowsNumber / rowsPerPage);

      let index = currentIndex;
      let page = currentPage;

      switch (evt.keyCode) {
        case 36: // Home
          page = 1;
          index = 0;
          break;
        case 35: // End
          page = lastPage;
          index = rowsPerPage - 1;
          break;
        case 33: // PageUp
          page = currentPage <= 1 ? lastPage : currentPage - 1;
          if (index < 0) {
            index = 0;
          }
          break;
        case 34: // PageDown
          page = currentPage >= lastPage ? 1 : currentPage + 1;
          if (index < 0) {
            index = rowsPerPage - 1;
          }
          break;
        case 38: // ArrowUp
          if (currentIndex <= 0) {
            page = currentPage <= 1 ? lastPage : currentPage - 1;
            index = rowsPerPage - 1;
          } else {
            index = currentIndex - 1;
          }
          break;
        case 40: // ArrowDown
          if (currentIndex >= lastIndex) {
            page = currentPage >= lastPage ? 1 : currentPage + 1;
            index = 0;
          } else {
            index = currentIndex + 1;
          }
          break;
      }

      if (page !== this.pagination.page) {
        this.pagination = {
          ...this.pagination,
          page,
        };

        this.$nextTick(() => {
          const { computedRows } = this.$refs.myTable;
          this.selected = [
            computedRows[Math.min(index, computedRows.length - 1)],
          ];
        });
      } else {
        this.selected = [computedRows[index]];
      }
    },
  },

  computed: {
    tableClass() {
      return this.navigationActive === true ? "shadow-8 no-outline" : void 0;
    },
  },
  mounted() {
    this.getDataList();
  },
};
</script>
