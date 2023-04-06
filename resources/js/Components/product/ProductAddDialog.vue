<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import ProductNewCategory from '@/Components/product/ProductNewCategory.vue';
import ProductNewUnitType from '@/Components/product/ProductNewUnitType.vue';

defineProps(['products','categories','unit_types']);
</script>

<script>

let form = useForm({
    image: null,
    product_name: '',
    stock_level: '',
    unit:'',
    unit_type_id:'',
    category_id: '',
});


export default {
    data: () => ({

      dialog: false,
      dialogCategory: false,
      dialogUnitType: false,
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
      dialogUnitType (val) {
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
        this.dialogUnitType = false
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
    openUnitType(){
      this.dialogUnitType=true
    },

    categoryUnitTypeSubmitForm(unit_type_form) {
   
      unit_type_form.post(route('unit_types.store'), { 
    onSuccess: () => {
      this.close();
      unit_type_form.reset();
    } 
  });
      },


    categorySubmitForm(categoryForm) {
      // console.log('asdasd',$title)

      categoryForm.post(route('categories.store'), { 
    onSuccess: () => {
      this.close();
      categoryForm.reset();
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
          max-width="600px"
          persistent
        >
          <template v-slot:activator="{ props }">
        
              <!-- New Unit Type-->
              <v-btn 
              color="primary"
              dark
              class="mb-2"
              @click="openUnitType"
             
            >
              New Unit Type
            </v-btn>
            <!-- New Unit Type -->

            
            <!-- New Category -->
            <v-btn 
              color="primary"
              dark
              class="mb-2"
              @click="openCategory"
             
            >
              New Category
            </v-btn>
            <!-- New Category -->

            <!-- New Product -->
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
            >
              New Product
            </v-btn>
            <!-- New Product -->


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
                    md="6"
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
                    md="3"
                  >

                  <v-select
                    v-model="form.unit_type_id"
                    :items="unit_types"
                    item-title="unit_type"
                    item-value="id"
                    label="Unit type"
                    density="comfortable"
                  ></v-select>
                  <InputError :message="form.errors.unit_type_id"/>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="3"
                  >
                    <v-text-field
                      v-model="form.unit"
                      label="Units"
                     
                    ></v-text-field>
                    <InputError :message="form.errors.unit"/>
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="form.stock_level"
                      label="Stock Level"
                    ></v-text-field>
                    <InputError :message="form.errors.stock_level"/>
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="8"
                  >

                  <v-select
                    v-model="form.category_id"
                    :items="categories"
                    item-title="title"
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


     <ProductNewUnitType
     :unit_types="unit_types" 
     :dialogUnitType="dialogUnitType" 
     @closeDialog="dialogUnitType=false" 
     @categoryUnitTypeSubmitForm="categoryUnitTypeSubmitForm">
     >
     </ProductNewUnitType>
    


 </template>