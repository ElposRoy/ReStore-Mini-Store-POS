<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductAddDialog from '@/Components/product/ProductAddDialog.vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['products','categories']);
</script>

<script>

export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      search: '',
      headers: [
        {
          title: 'Product name',
          align: 'start',
          sortable: false,
          key: 'product_name',
        },
        { title: 'Image', key: 'image' },
        { title: 'Price', key: 'price' },
        { title: 'Quantity', key: 'quantity' },
        { title: 'Category', key: 'category.title' },
        { title: 'Status', key: 'status' },
        { title: 'Actions', key: 'actions', sortable: false },
      ],
      // desserts: [],
      editedIndex: -1,
      // editedItem: {
      //   name: '',
      //   file: 0,
      //   price: 0,
      //   quantity: 0,
      //   category_id: '',
      //   status:'',
      // },
      // defaultItem: {
      //   name: '',
      //   file: 0,
      //   price: 0,
      //   quantity: 0,
      //   category_id: '',
      //   status:'',
      // },
    }),

    computed: {
    
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
     
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      // save () {
      //   if (this.editedIndex > -1) {
      //     Object.assign(this.desserts[this.editedIndex], this.editedItem)
      //   } else {
       
      //   }
      //   this.close()
      // },
    },
  }
</script>
 
<template>
    <Head title="Products" />
 
    <AuthenticatedLayout>
      <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <v-data-table
    :headers="headers"
    :items="products.data"
    :search="search"
    :sort-by="[{ key: 'product_name', order: 'asc' }]"
    class="elevation-1"
  >
  <template v-slot:[`item.image`]`="{ item }">
  
  <v-avatar
      size="100"
      rounded="0"
    >
      <v-img cover :src="'http://127.0.0.1:8000/'+item.columns.image"></v-img>
    </v-avatar> 
       <!-- <img :src="'http://127.0.0.1:8000/'+item.file" alt=""> -->
        </template>
        
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>R.E. STORE PRODUCTS</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>



        <ProductAddDialog>
          </ProductAddDialog>



        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

      

      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        size="small"
        class="me-2"
        @click="editItem(item.raw)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        size="small"
        @click="deleteItem(item.raw)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
        </div>

   
  
    </AuthenticatedLayout>
</template>