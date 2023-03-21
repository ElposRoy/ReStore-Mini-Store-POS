<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductAddDialog from '@/Components/product/ProductAddDialog.vue';
import ProductEditDialog from '@/Components/product/ProductEditDialog.vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import InputError from '@/Components/InputError.vue';
import { router } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head } from '@inertiajs/vue3';



defineProps(['products','categories']);


</script>

<script>
let editForm = useForm({
    id: null,
    image: null,
    product_name: '',
    price:'',
    quantity: '',
    category_id: '',
});

export default {
  
    data: () => ({
      dialog: false,
      dialogDelete: false,
      dialogEdit: false,
      
      search: '',
      headers: [
      { title: 'ID', key: 'id', },
        {
          title: 'Product name',
          align: 'start',
          sortable: false,
          key: 'product_name',
        },
       
        { title: 'Image', key: 'image' },
        { title: 'Price', key: 'price' },
        { title: 'Quantity', key: 'quantity' },
        { title: 'Category', key: 'category' },
        { title: 'Status', key: 'status' },
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
    editDialog (val) {
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
      // console.log(item.columns.id)
      
     this.editForm.image=item.columns.image;
    this.editForm.id=item.columns.id;
    this.editForm.product_name=item.columns.product_name;
    this.editForm.price=item.columns.price;
    this.editForm.quantity=item.columns.quantity;
    this.editForm.category_id=item.columns.category.id;
    this.dialogEdit = true;
    
    // alert(item.columns.category.id)
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

      deleteItemConfirm(){
        
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
      size="60"
      rounded="0"
      class="p-2"
    >
      <v-img cover :src="'http://127.0.0.1:8000/'+item.columns.image"></v-img>
    </v-avatar> 
       <!-- <img :src="'http://127.0.0.1:8000/'+item.file" alt=""> -->
        </template>

        <template v-slot:[`item.price`]`="{ item }">

          ₱ {{ item.columns.price.toFixed(2) }}

        </template>

        <template v-slot:[`item.category`]`="{ item }">
 {{ item.columns.category.title }}
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



        <ProductAddDialog :categories="categories"> <!-- Add this if splitting contents -->
          </ProductAddDialog>

<!-- EDIT DIALOG -->
          <v-dialog
          v-model="dialogEdit"
          max-width="500px"
          persistent
        >
          <v-card>
            <v-card-title>
              <span class="text-h5">Edit Product</span>
            </v-card-title>

            <v-card-text>
              <form @submit.prevent="submitProducts">
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                 <!-- <v-file-input
                    :value="form.file"

                    label="Product Image"
                    density="compact"
                  ></v-file-input> -->

                  <div class="mb-4">
                    <label for="file" class="block font-medium text-gray-700 mb-3">FILE</label>
                    <input
                        @input="editForm.image=$event.target.files[0]"
                        type="file"
                        name="image"
                        id="image"
                        required
                        placeholder="Enter your Image"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <InputError :message="editForm.errors.image" class="mt-2" />
                </div> 
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                    <v-text-field
                      v-model="editForm.product_name"
                      label="Product name"
                      
                    ></v-text-field>
                    <InputError :message="editForm.errors.product_name" />
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editForm.price"
                      label="Price"
                    ></v-text-field>
                    <InputError :message="editForm.errors.price" />
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editForm.quantity"
                      label="Quantity"
                    ></v-text-field>
                    <InputError :message="editForm.errors.quantity" />
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >

                  <v-select
                    v-model="editForm.category_id"
                    :items="categories"
                    item-title="title"
                    item-value="id"
                    label="Category"
                    density="comfortable"
                 
                    required
                  ></v-select>
                  <InputError :message="editForm.errors.category_id" />
                  </v-col>
                </v-row>
              </v-container>
              </form>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="editSubmitForm"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
<!-- EDIT DIALOG -->

<!-- Delete Dialog -->
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
<!-- Delete Dialog -->
      

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
        @click="openDelete"
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