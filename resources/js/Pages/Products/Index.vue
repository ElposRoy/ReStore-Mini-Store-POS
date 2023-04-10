<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductAddDialog from '@/Components/product/ProductAddDialog.vue';
import ProductEditDialog from '@/Components/product/ProductEditDialog.vue';
import ProductDeleteDialog from '@/Components/product/ProductDeleteDialog.vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['products','categories','unit_types']);
</script>

<script>

let editForm = useForm({
   
    image: null,
    id: null,
    product_name: '',
    stock_level: '',
    unit:'',
    unit_type_id:'',
    category_id: '',
});

export default {
  
    data: () => ({
      dialog: false,
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

  
  },

  created () {
    this.initialize()
  },

  methods: {
    initialize () {
  
    },
 
    openEdit(item) {

      editForm.id=item.columns.id;
      editForm.image=item.columns.image;
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

    close () {
        this.dialogEdit = false
        
      },
    closeDelete () {
        this.dialogDelete = false
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
              router.post(`/products/${editForm.id}`, {
              _method: 'put',
                ...this.editForm

              // id: this.editForm.id,
              // image: this.editForm.image,
              // product_name: this.editForm.product_name,
              // price:this.editForm.price,
              // quantity: this.editForm.quantity,
              // category_id: this.editForm.category_id,
            })

        //  this.editForm.put(route('products.update',this.editForm.id), { 
        //   onSuccess: () => {
        //     this.editForm.reset();
        //   this.close();
        //     } 
        //   });
     },

    //  editSubmitForm() {
    //      this.editForm.post((`/products/${this.editForm.id}`, this.editForm), { 
    //       onSuccess: () => {
    //         this.editForm.reset();
    //       this.close();
    //         } 
    //       });
    //  },


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
      size="80"
      rounded="0"
      class="p-2"
    >
      <v-img cover :src="'http://127.0.0.1:8000/'+item.columns.image"></v-img>
    </v-avatar> 
       <!-- <img :src="'http://127.0.0.1:8000/'+item.file" alt=""> -->
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

      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        size="small"
        class="me-2"
        @click="openEdit(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        size="small"
        @click="openDelete(deleteID=item.columns.id); "
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



