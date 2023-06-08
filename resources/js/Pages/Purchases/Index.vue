<script setup>
import AdminSideNav from '@/Layouts/AdminSideNav.vue';
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { VDataTable } from 'vuetify/labs/VDataTable'
import { router } from '@inertiajs/vue3'
import {useForm, Head } from '@inertiajs/vue3';
import PurchaseAddEditDialog from '@/Components/purchases/PurchaseAddEditDialog.vue';
import PurchaseDeleteDialog from '@/Components/purchases/PurchaseDeleteDialog.vue';
defineProps(['purchases','products']);
</script>

<script>


const restockForm = useForm ({
    id:null,
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
    baseurl: location.origin,
    isEdit: false,
    dialog: false,
    snackbar: false,
    dialogIndex: -1,
    dialogDelete: false,
    deleteId: null,
    search: '',
    headers: [
    { title: 'ID', key: 'id', align: ' d-none' },
      { title: 'Image', align: 'start', sortable: false, key: 'image'},
      { title: 'Product', key: 'product', align: 'center'},
      { title: 'Original Price', key: 'original_price' },
      { title: 'Sale Price', key: 'sale_price' },
      { title: 'Items', key: 'total_item'},
      { title: 'In Stock', key: 'quantity'},
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
    // console.log(this.purchases);
    this.initialize()
  },

  methods: {

  
    initialize () {
      
    },

    editItem (item) {
     
      this.isEdit=true;
      // this.dialogIndex=this.purchases.data.indexOf(item)
    restockForm.id=item.columns.id;
    restockForm.product_id=item.columns.product?.id || '';
    restockForm.original_price=item.columns.original_price;
    restockForm.sale_price=item.columns.sale_price;
    restockForm.quantity=item.columns.quantity;
    restockForm.purchasedDate=item.columns.purchased_at;
    restockForm.expirationDate=item.columns.expired_at;
    
    this.dialog=true;
    },

    deleteItem () {  //Open the Delete Dialog 
      this.dialogDelete=true
    },



    async deleteItemConfirm() { //Confirmation Deletion of Purchase
    
  try {
    await router.post(`/purchases/${this.deleteId}`, {
      _method: 'delete'
    });
    this.text = 'Deleted a Stock!'
    this.dialogDelete = false;
    this.snackbar = true
  } catch (error) {
    this.dialogDelete = true;
    this.text = 'Something went wrong!'
    this.snackbar = true
    // Handle error
  }
},

    close(){
  
      this.isEdit=false;
      this.dialogIndex=-1
      this.dialog=false
     this.restockForm.reset()
   
    },
   
    closeDelete () {
      this.dialogDelete = false
    },

  

   saveRestock() {
    this.dialog=true
    if (this.restockForm.processing) {
            return false
        }
         this.restockForm.post(route('purchases.store'), {
        onSuccess: () => {
          this.restockForm.reset()
          this.text = 'Successfully saved!'
        },
        onError: () => {
          this.dialog=true
          this.text = 'Something went wrong!'
          this.snackbar = true
        }
      });
    },

    editRestock(){
     
          router.post(`/purchases/${this.restockForm.id}`, {
        _method: 'put',
        ...this.restockForm
      }, {
        onSuccess: () => {
          this.close();
          this.text = 'Successfully updated the product!'
          this.snackbar = true
        },
        onError: () => {
          this.text = 'Something went wrong!'
          this.snackbar = true
        } 
      });
    },


  },
}
</script>



<template>
   <!-- :items-length="purchases.total" (For Data-table-server)--> 
    <Head title="Purchases" />
 
    <AdminSideNav>
      <!-- max-w-7x1 -->
      <div class="max-w mx-auto p-4 sm:p-6 lg:p-8">
        <v-data-table
    :headers="headers"
    :items="purchases.data"
    :search="search"
    :items-per-page="10"
    :sort-by="[{ key: 'purchased_at', order: 'desc' }]"
    class="elevation-1"
  >
  <template v-slot:[`item.image`]`="{ item }">
  
  <v-avatar
    size="60"
    rounded="0"
    class="p-2"
  >
  
  <v-img cover :src="item.columns.product.image ? item.columns.product.image  :baseurl+'/images/DefaultImage.png'" ></v-img>
  
  </v-avatar> 
     <!-- <img :src="'http://127.0.0.1:8000/'+item.file" alt=""> -->
      </template>

      
      <template v-slot:[`item.product`]="{ item }">
        {{ item.columns.product?.product_name || 'None' }}
      </template>





        <template v-slot:[`item.original_price`]="{ item }" >
          ₱ {{ item.columns.original_price}}
        </template>

        <template v-slot:[`item.sale_price`]="{ item }" >
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
      :isEdit="isEdit"
      :dialog="dialog"
      :title="formTitle"
      @close="dialog=false"
      @saveRestock="saveRestock"
      @editRestock="editRestock"
      >
    </PurchaseAddEditDialog>

    <PurchaseDeleteDialog
    :dialogDelete="dialogDelete"
  
    :deleteId="deleteId"
    @deleteItemConfirm="deleteItemConfirm"
    @closeDelete="dialogDelete=false"
    >

    </PurchaseDeleteDialog>

      
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
        @click="deleteItem(deleteId=item.columns.id)"
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
   
  
    </AdminSideNav>
</template>