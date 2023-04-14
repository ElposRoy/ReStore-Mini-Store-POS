<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { VDataTable } from 'vuetify/labs/VDataTable'
import { router } from '@inertiajs/vue3'
import {useForm, Head } from '@inertiajs/vue3';
import PurchaseAddEditDialog from '@/Components/purchases/PurchaseAddEditDialog.vue';

defineProps(['purchases','products']);
</script>

<script>


const restockForm = useForm ({
    product_id: '',
    original_price: '',
    sale_price: '',
    quantity: '',
    purchasedDate: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    expirationDate: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

})

//Date Format Function
//Convert Numerical date format to readable date 
function formatDate(dateString) {
  const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  const date = new Date(dateString);
  const day = date.getDate();
  const month = months[date.getMonth()];
  const year = date.getFullYear();
  return `${month} ${day}, ${year}`;
}


export default {
  data: () => ({
    dialog: false,
    snackbar: false,
    dialogIndex: -1,
    dialogDelete: false,
    search: '',
    headers: [
    { title: 'ID', key: 'id', align: ' d-none' },
      { title: 'Image', align: 'start', sortable: false, key: 'image'},
      { title: 'Product', key: 'product', align: 'center'},
      { title: 'Original Price', key: 'original_price' },
      { title: 'Sale Price', key: 'sale_price' },
      { title: 'Quantity', key: 'quantity'},
      { title: 'Date Purchased', key: 'purchased_at'},
      { title: 'Expiration Date', key: 'expired_at'},
      { title: 'Actions', key: 'actions', sortable: false },
    ],
  
  
  }),

  computed: {
      formTitle () {
        return this.dialogIndex === -1 ? 'New Purchase' : 'Edit Purchase'
      },
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
    
      // this.dialogIndex=this.purchases.data.indexOf(item)
    restockForm.product_id=item.columns.product.id;
    restockForm.original_price=item.columns.original_price;
    restockForm.sale_price=item.columns.sale_price;
    restockForm.quantity=item.columns.quantity;
    restockForm.purchasedDate=item.columns.purchased_at;
    restockForm.expirationDate=item.columns.expired_at;
    this.dialog=true;
    },

    deleteItem (item) {
      
    },

    deleteItemConfirm () {
      this.desserts.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    close(){
      this.dialogIndex=-1
      this.dialog=false
     this.restockForm.reset()
    },
   
    closeDelete () {
      this.dialogDelete = false
  
    },

   saveRestock() {
         this.restockForm.post(route('purchases.store'), {
        onSuccess: () => {
          this.restockForm.reset()
        },
        onError: () => {
          this.dialog= true
        } 

      });
    
    },
  },
}
</script>



<template>
   <!-- :items-length="purchases.total" (For Data-table-server)--> 
    <Head title="Purchases" />
 
    <AuthenticatedLayout>
      <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <v-data-table
    :headers="headers"
    :items="purchases.data"
    :search="search"
   
    :sort-by="[{ key: 'purchased_at', order: 'desc' }]"
    class="elevation-1"
  >
  <template v-slot:[`item.image`]`="{ item }">
  
  <v-avatar
    size="60"
    rounded="0"
    class="p-2"
  >
    <v-img cover :src="'http://127.0.0.1:8000/'+item.columns.product.image"></v-img>
  </v-avatar> 
     <!-- <img :src="'http://127.0.0.1:8000/'+item.file" alt=""> -->
      </template>

      <template v-slot:[`item.product`]`="{ item }" >
 {{ item.columns.product.product_name}}
        </template>

        <template v-slot:[`item.original_price`]`="{ item }" >
          ₱ {{ item.columns.original_price}}
        </template>

        <template v-slot:[`item.sale_price`]`="{ item }" >
          ₱ {{ item.columns.sale_price}}
        </template>

   


        <template v-slot:[`item.purchased_at`]`="{ item }" >
          {{ formatDate(item.columns.purchased_at) }}
        </template>

        <template v-slot:[`item.expired_at`]`="{ item }">
  {{ item.columns.expired_at ? formatDate(item.columns.expired_at) : '' }}
</template>


    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>STORE PURCHASES</v-toolbar-title>
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
       
      <PurchaseAddEditDialog
      :products="products"
      :purchases="purchases"
      :restockForm="restockForm"
      :dialog="dialog"
      :title="formTitle"
      @close="dialog=false"
      @saveRestock="saveRestock"
      >
    </PurchaseAddEditDialog>


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
    <template v-slot:item.actions="{ item, index }">
      <v-icon
        size="small"
        class="me-2"
        @click="dialogIndex=index; editItem(item)"
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
  
      <v-snackbar
      v-model="snackbar"
      multi-line
    >
      {{ text }}

      <template v-slot:actions>
        <v-btn
          color="red"
          variant="text"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
   
  
    </AuthenticatedLayout>
</template>