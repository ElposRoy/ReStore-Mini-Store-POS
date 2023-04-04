<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import ProductNewCategory from '@/Components/product/ProductNewCategory.vue';

defineProps(['products','categories']);


</script>

<script>

let form = useForm({
    image: null,
    product_name: '',
    price:'',
    quantity: '',
    category_id: '',
});


export default {
    data: () => ({

      dialog: false,
      dialogCategory: false,
    }),

    computed: {
   
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogCategory (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
    
      },

  
      close () {
        this.dialog = false
        this.dialogCategory = false
      
      },
      submitForm() {
        this.form.post(route('products.store'), { 
  onSuccess: () => {
    this.close();
    this.form.reset();
  } 
});
    },
    openCategory() {
      this.dialogCategory=true
    },


    categorySubmitForm($title) {
      // console.log('asdasd',$title)

          $title.post(route('categories.store'), { 
    onSuccess: () => {
      this.close();
      this.form.reset();
    } 
  });
      },
    },
  }
</script>
 <template>
  <!-- ADD DIALOG -->
    <v-dialog
          v-model="dialog"
          max-width="500px"
          persistent
        >
          <template v-slot:activator="{ props }">
        

            <v-btn 
              color="primary"
              dark
              class="mb-2"
              @click="openCategory"
             
            >
              New Category
            </v-btn>
            
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
            >
              New Product
            </v-btn>
         
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">New Product</span>
            </v-card-title>

            <v-card-text>
              <form @submit.prevent="submitForm">
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
                        @input="form.image=$event.target.files[0]"
                        type="file"
                        name="image"
                        id="image"
                        required
                        placeholder="Enter your Image"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <InputError :message="form.errors.image" />
                </div> 


                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                    <v-text-field
                      v-model="form.product_name"
                      label="Product name"
                     
                    ></v-text-field>
                    <InputError :message="form.errors.product_name"/>
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="form.price"
                      label="Price"
                    ></v-text-field>
                    <InputError :message="form.errors.price"/>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="form.quantity"
                      label="Quantity"
                    ></v-text-field>
                    <InputError :message="form.errors.quantity"/>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >

                  <v-select
                    v-model="form.category_id"
                    :items="categories"
                    item-text="title"
                    item-value="id"
                    label="Category"
                    density="comfortable"
                  ></v-select>
                  <InputError :message="form.errors.category_id"/>
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
                @click="submitForm"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
     </v-dialog>
  <!-- ADD DIALOG -->

     <ProductNewCategory 
     :categories="categories" 
     :dialogCategory="dialogCategory" 
     @closeDialog="dialogCategory=false" 
     @categorySubmitForm="categorySubmitForm">
     </ProductNewCategory>


 </template>