<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductAddDialog from '@/Components/product/ProductAddDialog.vue';
import ProductEditDialog from '@/Components/product/ProductEditDialog.vue';
import ProductDeleteDialog from '@/Components/product/ProductDeleteDialog.vue';
import ProductRestockDialog from '@/Components/product/ProductRestockDialog.vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['products','categories','unit_types']);
</script>

<script>

let editForm = useForm({
   
    image: null,
   currentImage: null,
    id: null,
    product_name: '',
    stock_level: '',
    unit:'',
    unit_type_id:'',
    category_id: '',
});

const restockForm = useForm ({
    id:null,
    product_id: '',
    original_price: '',
    sale_price: '',
    quantity: '',
    purchasedDate: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    expirationDate: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
})

export default {
  
    data: () => ({
      baseurl : location.origin,
      dialogRestock: false,
      dialog: false,
      snackbar: false,
      dialogDelete: false,
      dialogEdit: false,
      deleteID: null,
      search: '',
      headers: [
        
      { title: 'ID', key: 'id', align: ' d-none' },
      { title: 'Image', key: 'image' },
        {
          title: 'Product Name',
          align: 'start',
          sortable: false,
          key: 'product_name',
        },
        { title: 'Category', key: 'category' },
        { title: 'Stock Level', key: 'stock_level',  align: 'center' },
        { title: 'Unit', key: 'unit',  align: 'center' },
        { title: 'Unit Type', key: 'unit_type',  align: 'center' },
        { title: 'Quantity', key: 'purchases',  align: 'center' },
        { title: 'Actions', key: 'actions', sortable: false },
      ],
      // prod:{}
    }),
    computed: {
   
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogEdit (val) {
      val || this.close()
    },
    dialogRestock (val) {
        val || this.close()
      },
  
  },

  created () {
    this.initialize()
  },

  methods: {
 
    initialize () {
  
    },

    rowClass(item) {
      
      if (item.stock_level > this.getQuantity(item)) {
       
        return 'red'
      }
        else{
         
          return 'green'
        } 


      // console.log(item.stock_level)
      // if(item.stock_level <= this.getQuantity(item)){
      //   console.log('if')
      //   return 'color: red';

      // }
     
      //  else{
      //   console.log('else')
      //   return 'color:green';
      //  }
      },
     



    getQuantity(item){
      
      return item.purchases?.reduce((acc,row)=>{
        acc+=row.quantity
        return acc
      },0)
    },
 
    openEdit(item) {

      editForm.id=item.columns.id;
      editForm.image=item.columns.image;
      editForm.currentImage=item.columns.image;
      editForm.product_name=item.columns.product_name;
      editForm.unit=item.columns.unit;
      editForm.stock_level=item.columns.stock_level;
      editForm.unit_type_id=item.columns.unit_type.id;
      editForm.category_id=item.columns.category.id

    // this.editForm.image=item.columns.image;
    // this.editForm.id=item.columns.id;
    // this.editForm.price=item.columns.price;
    // this.editForm.quantity=item.columns.quantity;
    // this.editForm.category_id=item.columns.category.id;
   this.dialogEdit = true;
    
    
  },
    openDelete(){
      this.dialogDelete = true;
      
    },
    openRestock(item){
      
      restockForm.product_name=item.columns.product_name
      restockForm.product_id=item.columns.id
      this.dialogRestock = true;
    },


    close () {
        this.dialogEdit = false
        
      },
    closeDelete () {
        this.dialogDelete = false
      },
    closeRestock(){
      this.dialogRestock = false
      this.restockForm.reset();
      
    },


      async deleteItemConfirm() {
        try {
          await router.post(`/products/${this.deleteID}`, {
            _method: 'delete'
          });
          this.dialogDelete = false;
        } catch (error) {
          // Handle error
        }
        },

      editSubmitForm() {
        router.post(`/products/${this.editForm.id}`, {
          _method: 'put',
          ...this.editForm
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
                    // id: this.editForm.id,
                    // image: this.editForm.image,
                    // product_name: this.editForm.product_name,
                    // price:this.editForm.price,
                    // quantity: this.editForm.quantity,
                    // category_id: this.editForm.category_id,

              //  this.editForm.put(route('products.update',this.editForm.id), { 
              //   onSuccess: () => {
              //     this.editForm.reset();
              //   this.close();
              //     } 
              //   });

        },

      saveRestock(){
      

        router.post(`/products/${this.restockForm.product_id}/purchases`, {
          _method: 'post',
          ...this.restockForm
        }, {
          onSuccess: () => {
            this.close();
            this.restockForm.reset();
            this.text = 'Successfully restocked product!'
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
    <Head title="Products" />
 
    <AuthenticatedLayout>
      <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <v-data-table
    :headers="headers"
    :items="products.data"
    :search="search"
    :item-class="rowClass"
    :sort-by="[{ key: 'product_name', order: 'asc' }]"
    class="elevation-1"
  >
  <template v-slot:[`item.image`]`="{ item }">
  
    <v-avatar
      size="60"
      rounded="0"
      class="p-2"
    >
    <!-- Create :src = if else for image or null image default -->
      <v-img cover :src="item.columns.image ? item.columns.image  : baseurl+'/images/DefaultImage.png'"></v-img> 
    </v-avatar> 

        </template>

        <!-- <template v-slot:[`item.price`]`="{ item }">

          ₱ {{ item.columns.price.toFixed(2) }}

        </template> -->

        <template v-slot:[`item.category`]`="{ item }" >
          {{ item.columns.category.title }}
        </template>

        
        <template v-slot:[`item.unit_type`]`="{ item }">
        {{ item.columns.unit_type.unit_type}}
        </template>

        <template v-slot:[`item.purchases`]`="{ item }" >
          <v-chip :color="rowClass(item.columns)">   
        {{ getQuantity(item.columns) }}
      </v-chip>
        </template>

        


  <!-- TOP TABLE -->
      <template v-slot:top>

        
        <v-toolbar
          flat
        >
          <v-toolbar-title>STORE PRODUCTS</v-toolbar-title>
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



            <ProductAddDialog 
          :categories="categories"
          :unit_types="unit_types"
          > <!-- Add this if splitting contents -->
            </ProductAddDialog>

            <ProductEditDialog
            
            :products="products"
            :categories="categories"
            :unit_types="unit_types"
            :dialogEdit="dialogEdit"
            :editForm="editForm"
            @closeDialog="dialogEdit=false"
            @editSubmitForm="editSubmitForm">

            </ProductEditDialog>

            <ProductDeleteDialog 
            :dialogDelete="dialogDelete"
            :deleteID="deleteID"
            @closeDelete="dialogDelete=false"
            @deleteItemConfirm="deleteItemConfirm"
            >
            </ProductDeleteDialog>

            <ProductRestockDialog
            :products="products"
            :dialogRestock="dialogRestock"
            :restockForm="restockForm"
            @closeRestock="closeRestock"
            @saveRestock="saveRestock">
    
     </ProductRestockDialog>

        </v-toolbar>
      </template>
  <!-- TOP TABLE -->

    <!-- ACTION BUTTON -->
    <template v-slot:item.actions="{ item }">
      <!-- Restock Button -->
      <v-icon
        size="small"
        class="me-2"
        @click=" openRestock(item)"
      >
      mdi-archive-arrow-down
      </v-icon>
      <!-- Edit Button -->
      <v-icon
        size="small"
        class="me-2"
        @click="openEdit(item)"
      >
        mdi-pencil
      </v-icon>

      <!-- Delete Button -->
      <v-icon
        size="small"
        @click="openDelete(deleteID=item.columns.id); "
      >
        mdi-delete
      </v-icon>
    </template>
     <!-- ACTION BUTTON -->

      <!-- RESET -->
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
     <!-- RESET -->

  </v-data-table>
        </div>
      
  


        <v-snackbar
        :timeout="6000"
        v-model="snackbar"
      multi-line
      color="success"
    
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



